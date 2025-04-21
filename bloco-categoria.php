<?php 
	$categoria = new Categoria();
	$categoriaDao = new CategoriaDao();

	$categoria = $categoriaDao->listarCategorias();


	for($i=0;$i<count($categoria);$i++){

			$link = "/portal-de-ajudas/conta/categoria/ajudas.php?codCateg=".$categoria[$i]->getCodigo().""; 
	?>

		<div class="col-12 col-md-5 col-sm-12 d-inline-block" style="margin-bottom:1em;">

			<div class="card text-center">

				<a href="<?= $link ?>" style="color:black; text-decoration:none;">
					<div class="card-block" style="padding:1em;">
						
						<p class="card-text">
							<?= $categoria[$i]->getNomeCategoria() ?>
						</p>

					</div>
				</a>

			</div>
		</div>	
<?php 
	} 
?>

