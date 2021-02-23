<?php 

	include_once("coneccion.php");

	if(empty($_POST['pregunta']) || empty($_POST['idProd'])){
		echo 'no';
	}else{
		$pregunta = $_POST['pregunta'];
		$idProd = $_POST['idProd'];
		$SQLServer = $handler->prepare("INSERT INTO consultas VALUES (null, '$pregunta','', '$idProd', null)");
		if($SQLServer->execute()){
			$insert = true;
		}    
		echo 'ok';
	}

?>