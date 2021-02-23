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
						<option value="" style="display: none;"><?php echo $ordenSelect;?></option>
						<option value="ar">Mas antiguas a mas recientes</option>
						<option value="ra">Mas recientes a mas antiguas</option>
						<option value="al">Por orden aleatorio</option>
					</select>
					<input type="hidden" name="orden">
				</div>
			</form>	

			<div id="consultas"></div>
		</main>
	</div>
</body>
<script>
	document.querySelector("#selectOrden").onchange = function(){
		document.querySelector("[name='orden']").value=this.value
		$("#formOrden").submit();
	}

	document.body.onkeypress = function(e){
		if(e.which == 13){
			document.querySelectorAll("form").forEach(function(form, i){
				$(form).on('submit', function(e){
					e.preventDefault();
				});
			})
		} 
	}

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
	})



	function mostrar(){
		var xmlhttp; //Comprobar si estas en chrome o posteriores o internet explorer
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new activeXObject("Microsoft.XMLhttp");
		}
		xmlhttp.onreadystatechange = function(){ 
			if(xmlhttp.readyState === 4 && xmlhttp.status === 200){					
				document.querySelector("#consultas").innerHTML = xmlhttp.responseText;
			}
		}
		var variables = "accion=mostrar&";
		xmlhttp.open("POST", "SQL_nuevaConsulta.php", true) //metodo get, documento a agarrar, asignacion asincrona (no sera recargada);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(variables)
	}

	mostrar();

	function actualizar(id){
		Swal.fire({
		  title: '¿Desea enviar su respuesta?',
		  text: "El usuario podra verla desde la pagina del producto",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Enviar respuesta',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				data = $('#consulta'+id).serializeArray();
				data.push(
					{name: 'accion', value: 'actualizar'},
					{name: 'id', value: id},
				)
				$.ajax({
				    url: 'SQL_nuevaConsulta.php',
				    type: 'post',
				    dataType: 'json',
				    data: data,
				    beforeSend: function(){
				        $('.submitBtn').attr("disabled","disabled");
				        $('#formConsulta').css("opacity",".5");
				    },
				})


				.done(function(){
					Toast.fire({
						icon: 'success',
						title: 'La respuesta ha sido enviada',
						didOpen: () => {
						}
					})
							mostrar();
				})
				.fail(function(){
					Toast.fire({
					  icon: 'error',
					  title: 'Error al enviar la respuesta, intente nuevamente',
					})
				})
			}
		})
	}

	function eliminar(id){
		Swal.fire({
		  title: '¿Está seguro de querer eliminar la consulta?',
		  text: "Esta acción no podrá revertirse después",
		  icon: 'warning',
		  showCancelButton: true,
		  cancelButtonColor: '#3085d6',
		  confirmButtonColor: '#d33',
		  confirmButtonText: 'Eliminar consulta',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				data = $('#consulta'+id).serializeArray();
				data.push(
					{name: 'accion', value: 'eliminar'},
					{name: 'id', value: id},
				)
				$.ajax({
				    url: 'SQL_nuevaConsulta.php',
				    type: 'post',
				    dataType: 'json',
				    data: data,
				    beforeSend: function(){
				        $('.submitBtn').attr("disabled","disabled");
				        $('#formConsulta').css("opacity",".5");
				    },
				})
				.done(function(){
					Toast.fire({
						icon: 'success',
						title: 'Consulta eliminada satisfactoriamente',
						didOpen: () => {
							mostrar();
						}
					})
				})
				.fail(function(){
					Toast.fire({
					  icon: 'error',
					  title: 'Error al eliminar, intente nuevamente',
					})
				})
			}
		})
	}
</script>
</html>