$(function () {
	$("#text").keydown(function (e) {
		if (e.keyCode === 13) {
			writeMsg(chatId,  $(this).val(), userId);
			$("#body-msgs").append("<span style='float: left;'>me: " + $("#text").val() + "</span><br/>")
				.scrollTop(100);
			$(this).val("");
		}
	});

	$("#text").emojioneArea({
		pickerPosition: "bottom",
		filtersPosition: "bottom",
		tonesStyle: "checkbox"
	});
});