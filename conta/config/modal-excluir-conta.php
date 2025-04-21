    <div class="modal fade" id="excluirConta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> 
                        <img class="float-left" src="../../assets/images/icones/trash.png" width="25em" height="auto" /> 
                        <span style="margin-left:1em;"> Alerta - Exclusão de Conta</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h6>Deseja realmente excluir a sua conta?</h6>
                </div>
                <div class="modal-footer">  
                    <form action="scripts/excluir-conta.php" method="POST">
                        
                        <input type="hidden" name="codPessoa" value="<?= $pessoa->getCodigo() ?>" />

                        <input type="submit" class="btn btn-danger" style="width:3.5em;" value="Sim" />
                        <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Não" />

                    </form>            
                </div>
            </div>
        </div>
    </div> <!-- Fim Modal -->
