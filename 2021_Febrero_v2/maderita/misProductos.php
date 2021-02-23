<?php 

	session_start();


	include_once("coneccion.php");
	if(empty($_SESSION['usuario'])){
		header("location: iniciar_sesion.php");
	}

	$SQLStatement = $handler->prepare("SELECT * FROM categorias");
	$SQLStatement->execute();
	$v_categorias = $SQLStatement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="js/funciones_propias.js"></script>
</head>
<style>
	
</style>
<body>
	<div class="container-fluid m-0 p-0">
		<div class="row m-0">
			<h1 class="order-md-2 col-12 col-md-10 bg-info m-0 py-4 text-white text-center">Elige la categoria del producto que buscas</h1>
			<a href="administrador.php" class="order-md-1 py-md-0 px-0 btn btn-info col-12 col-md-2 btn_volver">
				<div class="">
					<span style="">Volver</span>
				</div>
			</a>
		</div>
		<main class="container">	
			<div class="row">	
				<a href="catNuevoProducto.php" class="col-12 p-0">
		          <button class="btn btn-info mt-3 mb-3 py-3 col-12">Cargar un producto nuevo</button>
		        </a>
			</div>


			<div id="div_categorias">
				<div class="row justify-content-center">
<?php 
					foreach ($v_categorias as $i => $vc) {
?>
						<form action="misProductosFiltrados.php" method="post" id="cat<?php echo $vc['id']; ?>" class="col-12 col-sm-6 col-md-4 p-2" onclick="irALaCategoria(<?php echo $vc['id']; ?>, this)">
							<div class="border">
								<img class="col-12 p-0" src="<?php echo $vc['img']; ?>" alt="">
								<div class="col-12 text-center">
									<?php echo $vc["categoria"]; ?>
								</div>
							</div>
						</form>
<?php 
					}
?>
				</div>
			</div>
		</main>
	</div>
</body>
<script>
	function irALaCategoria(id, form){
		var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "idCat").val(id);
        $(form).append(input)
		$(form).submit()
	}
</script>
</html>