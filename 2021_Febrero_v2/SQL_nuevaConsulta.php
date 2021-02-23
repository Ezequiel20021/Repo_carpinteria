<?php 
	include_once("coneccion.php");
	if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}else{
		$accion = "nada";
	}
	switch ($accion) {
		case "mostrar":

		$SQLServer = $handler->prepare("SELECT * FROM consultas WHERE respuesta = ''");
		$SQLServer->execute();
		$v_consultas = $SQLServer->fetchAll();

		$SQLServer = $handler->prepare("SELECT * FROM productos");
		$SQLServer->execute();
		$v_productos = $SQLServer->fetchAll();
		if(count($v_consultas) > 0){
			foreach ($v_consultas as $i => $vc) {
				foreach ($v_productos as $j => $vp) {
					if($vc["idProducto"] == $vp["id"]){	
						if($vc["respuesta"]==""){
?>
							<div class="mc_consulta row mb-4">
								<header class="col-12 bg-info">
									<div class="row">
										<div class="col-2 p-2">
											<img src="<?php echo $vp['img']?>" alt="" class="col-12">
										</div>
										<div class="col-10 row p-2 pb-0">
											<a class="col-12" href="producto.php?idProducto=<?php echo $vp['id']?>" target="_blank"><?php echo $vp['producto']?></a>
											<span class="col-12">$<?php echo $vp['precio']?> x <?php echo $vp['stock']?> disponibles</span>
										</div>
										<span class="col-12 text-dark" style="opacity: 0.7"><?php echo $vc['fechaDeCarga']?></span>
									</div>
								</header>
								<div class="col-12">	
									<div class="col-12 mc_pregunta text-dark pt-3 p-0" style="font-size: 20px; color: black">
										<?php echo $vc['pregunta']?>
									</div>
									<form id="consulta<?php echo $vc['id']?>" method="post">
										<input class="form-control my-2 py-1 pb-4" name="respuesta" autocomplete="off" placeholder="Respuesta" style="cursor:text; height:auto">
									</form>
									<div class="row justify-content-end">
										<button type="button" class="btn btn-info col-6 col-md-3" onclick="actualizar(<?php echo $vc['id']?>)">Responder pregunta</button>
										<button type="button" class="btn btn-danger col-6 col-md-3" style="opacity: 0.8" onclick="eliminar(<?php echo $vc['id']?>)">Eliminar pregunta</button>
									</div>
								</div>
							</div>
<?php 
						}
					}
				}
			}
		}else{
			echo '<h1 class="text-center">Has respondido todas las preguntas</h1>';
		}
		;break;
		case "actualizar":
			if(empty($_POST['respuesta'])){
				echo false;
			}else{
				$respuesta = $_POST['respuesta'];
				$id = $_POST['id'];
				$SQLServer = $handler->prepare("UPDATE consultas SET respuesta = '$respuesta' WHERE id = $id");
				if($SQLServer->execute()){
					echo true;
				}    
			}
		;break;
		case "eliminar":
			$id = $_POST['id'];
			$SQLServer = $handler->prepare("DELETE FROM consultas WHERE id = $id");
			if($SQLServer->execute()){
				echo true;
			}    
		;break;
		case "cargar":
			$pregunta = $_POST['pregunta'];
			$idProd = $_POST['idProd'];

			$SQLServer = $handler->prepare("INSERT INTO consultas VALUES (null, '$pregunta', '', '$idProd', null )");
			if($SQLServer->execute()){
				echo true;
			}    
		;break;
	}

?>