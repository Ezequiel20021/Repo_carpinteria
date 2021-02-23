<!DOCTYPE html>
<html lang="en">

<?php 
	session_start();


	include_once("coneccion.php");
	if(empty($_SESSION['usuario'])){
		header("location: iniciar_sesion.php");
	}
?>
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
		<h1 class="col-12 bg-info m-0 py-4 text-white text-center mb-4">Sector Administrador</h1>
		<main class="container">	
			<div class="row justify-content-center mb-4">
				<a href="misConsultas.php" class="bg-info text-white adm_panel py-4 col-12 col-md-8 text-center border"><h2>Mis consultas</h2></a>
			</div>
			<div class="row justify-content-center mb-4">
				<a href="misProductos.php" class="bg-info text-white adm_panel py-4 col-12 col-md-8 text-center border"><h2>Mis productos</h2></a>
			</div>
			<div class="row justify-content-center mb-4">
				<a href="misCategorias.php" class="bg-info text-white adm_panel py-4 col-12 col-md-8 text-center border"><h2>Mis categorías</h2></a>
			</div>
			<div class="row justify-content-center mb-4">
				<a onclick="confirmarParaSalir('logout.php')" class="bg-info text-white adm_panel py-4 col-12 col-md-8 text-center border"><h2>Cerrar sesión</h2></a>
			</div>
		</main>
	</div>
</body>
<script type="text/javascript">
	function confirmarParaSalir(pag){
	    conf  = confirm("¿Está seguro de querer salir del modo administrador?")
	    if(conf){
	    	window.location.href = pag;
	    }
	}
</script>
</html>