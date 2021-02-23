<!DOCTYPE html>
<html lang="en">

<?php 

	session_start();
	include_once("coneccion.php");
	
	if(empty($_SESSION['usuario'])){
		header("location: iniciar_sesion.php");
	}

	$SQLServer = $handler->prepare("SELECT * FROM consultas");
	$SQLServer->execute();
	$v_consultas = $SQLServer->fetchAll();

	$SQLServer = $handler->prepare("SELECT * FROM productos");
	$SQLServer->execute();
	$v_productos = $SQLServer->fetchAll();


	$ordenSelect = "Mas antiguas a mas recientes";
	function shuffle_assoc($array) {
	    $keys = array_keys($array);
	    shuffle($keys);
	    foreach($keys as $key) {
	        $new[$key] = $array[$key];
	    }
	    return $new;
	}
	if(isset($_POST['orden'])){	
		switch ($_POST['orden']){
			case 'ra':
				$v_consultas = array_reverse($v_consultas);
				$ordenSelect = "Mas recientes a mas antiguas";
			break;
			case 'al':
				$v_consultas = shuffle_assoc($v_consultas);
				$ordenSelect = "Por orden aleatorio";
			break;
		}
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
		<div class="row m-0 bg-info">
			<h1 class="order-md-2 col-12 col-md-10 bg-info m-0 py-4 text-white text-center">Mis consultas</h1>
			<a href="administrador.php" class="order-md-1 py-md-0 px-0 btn btn-info col-12 col-md-2 btn_volver">
				<div class="">
					<span style="">Volver</span>
				</div>
			</a>
		</div>
		<main class="container">
		<form id="formOrden" action="" method="post">
			<div class="row">	
				<select id="selectOrden" class="col-12 mt-3 mb-3" style="text-align-last: center; cursor:pointer">
					<option value="" style="display: none;"><?php echo $ordenSelect; ?></option>
					<option value="ar">Mas antiguas a mas recientes</option>
					<option value="ra">Mas recientes a mas antiguas</option>
					<option value="al">Por orden aleatorio</option>
				</select>
				<input type="hidden" name="orden">
			</div>
		</form>	


			<div id="consultas">
				<?php 
					foreach ($v_consultas as $i => $vc) {
						foreach ($v_productos as $j => $vp) {
							if($vc["idProducto"] == $vp["id"]){	
								if($vc["respuesta"]==""){
									echo '
										<div class="mc_consulta row mb-4">
											<header class="col-12 bg-info">
												<div class="row">
													<div class="col-2 p-2">
														<img src="'.$vp["img"].'" alt="" class="col-12">
													</div>
													<div class="col-10 row p-2 pb-0">
														<a class="col-12" href="producto.php?idProducto='.$vp["id"].'" target="_blank">'.$vp["producto"].'</a>
														<span class="col-12">$'.$vp["precio"].' x '.$vp["stock"].' disponibles</span>
													</div>
													<span class="col-12 text-dark" style="opacity: 0.7">'.$vc["fechaDeCarga"].'</span>
												</div>
											</header>
											<div class="col-12">	
												<div class="col-12 mc_pregunta text-dark pt-3 p-0">
													'.$vc["pregunta"].'
												</div>
												<div class="form-control my-2 d-none" contenteditable="" style="cursor:text; height:auto">
													Respuesta
												</div>
												<div class="row justify-content-end">
													<button class="btn btn-info col-6 col-md-3">Responder pregunta</button>
													<button class="btn btn-danger col-6 col-md-3" style="opacity: 0.8">Eliminar pregunta</button>
												</div>
											</div>
										</div>
									';
								}
							}
						}
					}
				?>

			</div>
		</main>
	</div>
</body>
<script>
	document.querySelector("#selectOrden").onchange = function(){
		document.querySelector("[name='orden']").value=this.value
		$("#formOrden").submit();
	}
</script>
</html>