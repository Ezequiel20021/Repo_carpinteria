<?php 
	include_once("coneccion.php");
	if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}else{
		$accion = "nada";
	}
	print($accion);
	switch ($accion) {
		case "mostrar":
			echo $table = "";
			$consulta = "SELECT * FROM categorias";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			$SQLStatement->execute();
			$resultado = $SQLStatement->fetchAll();

			$table .= '<div class="container">';
			$table .= '<table class="table table-striped table-bordered">';
			$table .= '<tr>';
			$table .= '<th class="text-center">Id</th>';
			$table .= '<th class="text-center">Categoria</th>';
			$table .= '<th class="text-center">Imagen</th>';
			$table .= '<th class="text-center">Editar</th>';
			$table .= '<th class="text-center">Eliminar</th>';
			$table .= '</tr>';
			foreach ($resultado as $i => $el) {
				$table .= '<tr>';
				$table .= '<th class="text-center usuarioDato" caracteristica="id" userId="'.$el['id'].'">'.$el['id'].'</th>';
				$table .= '<th class="text-center usuarioDato" caracteristica="categoria" userId="'.$el['id'].'">'.$el['categoria'].'</th>';
				$table .= '<th class="text-center usuarioDato" caracteristica="categoria" userId="'.$el['id'].'"><img class="col-12 col-sm-12 col-md-3" src="'.$el['img'].'"></th>';
				$table .= '<th class="text-center"><button class="btn btn-secondary" onclick="editarUsuario(this, '.$el["id"].')">Editar</button></th>';
				$table .= '<th class="text-center" caracteristica="eliminar" userId="'.$el['id'].'"><button class="btn btn-danger" onclick="eliminarUsuario('.$el["id"].')">Eliminar</button></th>';
				$table .= '<th class="text-center d-none" caracteristica="actualizar" userId="'.$el['id'].'"><button class="col-12 col-md-6 btn btn-primary" onclick="actualizarUsuario('.$el["id"].')">Actualizar</button><button class="col-12 col-md-6 btn btn-info" onclick="actualizarUsuario()">Cancelar</button></th>';
				$table .= '</tr>';
			}
			echo $table;
		break;
		case "cargar": 
			if(!empty($_POST['producto']) || !empty($_FILES['file']['name'])){
			    $producto = $_POST['producto'];
			    $descripcion = $_POST['descripcion'];
			    $acotacion = $_POST['acotacion'];
			    $precio = $_POST['precio'];
			    $id_categoria = $_POST['id_categoria'];
			    $stock = $_POST['stock'];
			    $uploadedFile = '';
			    if(!empty($_FILES["file"]["type"])){
			        $fileName = time().'_'.$_FILES['file']['name'];
			        $valid_extensions = array("jpeg", "jpg", "png");
			        $temporary = explode(".", $_FILES["file"]["name"]);
			        $file_extension = end($temporary);
			        $targetPath = "uploads/productos/".$fileName;
			    }

			    $consulta = "INSERT INTO productos VALUES(null, '$producto','$descripcion','$acotacion','$precio','$id_categoria', '$stock', '$targetPath')";
			    $sqlConect = $handler->prepare($consulta);

			    if($sqlConect->execute()){
			        if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
			            $sourcePath = $_FILES['file']['tmp_name'];
			            if(move_uploaded_file($sourcePath,$targetPath)){
			                $uploadedFile = $fileName;
			            }
			        }
			        $insert = true;
			    }
			    
			    //include database configuration file
			    
			    //insert form data in the database
			    // $insert = $db->query("INSERT form_data (name,email,file_name) VALUES ('".$name."','".$email."','".$uploadedFile."')");

			    
			    echo $insert?'ok':'no';

			    header("location: misProductos.php");
			}
		break;
		case "actualizar": 
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$edad = $_POST['edad'];
			$id = $_POST['id'];

			$consulta = "UPDATE categorias SET nombre = '$nombre', apellido = '$apellido', edad = '$edad' WHERE id= '$id'";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			echo $consulta;
			if($SQLStatement->execute()){
				echo "LISTO";
			}
		break;
		case "eliminar":
			$id = $_POST['id'];
			$consulta = "DELETE FROM categorias WHERE id= $id";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			$SQLStatement->execute();
		break;
	

	}
?>