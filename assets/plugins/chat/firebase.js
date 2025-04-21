//let chatId = "dfwhtrwht2"; //criar o chatid no backend
let chatId = document.getElementById("chatId").value;
let de = new Date();
//let toHash = (de.toLocaleString().replace("/", "-").replace("/", "-")); // remover essa linha
//let userId = toHash; //pegar o user id do backend
let userId = document.getElementById("codUsuario").value; 

function writeMsg(chatId, msg) {
    let d = new Date();
    let date = (d.toLocaleString().replace("/", "-").replace("/", "-"));

    firebase.database().ref('chat/' + chatId + '/msgs/' + date).set({
        msg: msg,
        people: userId,
    });

    return firebase.database().ref('/chat/' + chatId + "/count").once('value').then(function (snapshot) {
        let count = snapshot.child("count").val();

        if (count === null) {
            count = 1;
        } else {
            count += 1;
        }
        firebase.database().ref('chat/' + chatId + '/count').set({count: count});
    });
}

firebase.initializeApp(config);

window.onload = function() {

    let ref = firebase.database().ref('chat/' + chatId + '/msgs/');
    ref.orderByKey().limitToLast(5).once('value', function (snapshot) {
        console.log(snapshot);
        snapshot.forEach(function (childSnapshot) {
            let content = childSnapshot.val();
            if (content.people === userId) {
                $("#body-msgs").append("<span style='float: left;'>me:" + content.msg + "</span><br/>");
            } else {
                $("#body-msgs").append("<span style='float: right;'>you:" + content.msg + "</span><br/>");
            }
        });
    });

    ref.orderByKey().limitToLast(1).on('value', function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            let content = childSnapshot.val();
            if (content.people !== userId) {
                $("#body-msgs").append("<span style='float: right;'>you:" + content.msg + "</span><br/>");
            }
        });
    });
}
