<?php 
	include_once("coneccion.php");
	if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}else{
		$accion = "nada";
	}
	switch ($accion) {
		case "mostrar":
			echo $table = "";
			$consulta = "SELECT * FROM categorias";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			$SQLStatement->execute();
			$resultado = $SQLStatement->fetchAll();
?>
			<div class="">
			<div class="flex-table">
				<div class="grid">
					<div class="grid__row grid__row--header">
				      <div class="grid__wrapper">
				        <div class="grid__item">
				        	Id
				        </div>
				        <div class="grid__item">
				        	Categoria
				        </div>
				        <div class="grid__item">
				        	Imagen
				        </div>
						<div class="grid__item">
				        	Editar
				        </div>
						<div class="grid__item">
				        	Eliminar
				        </div>
					</div>
<?php
				foreach ($resultado as $i => $el) {
?>
				<form id="formNewData<?php echo $el['id']?>" class="grid__row mb-5 mt-2">
					<div class="grid__wrapper">
				        <div class="grid__item text-center usuarioDato" caracteristica="id" userId="<?php echo $el['id'] ?>"><?php echo $el['id']?></div>
						<div class="m-2 grid__item text-center usuarioDato" caracteristica="categoria" userId="<?php echo $el['id'] ?>"><?php echo $el['categoria']?></div>

						<div class="grid__item text-center usuarioDato justify-content-center" caracteristica="imagen" userId="<?php echo $el['id'] ?>" style="">
							<div class="col-12 p-0 justify-content-center" style="display: inline-block;position: relative">
								<img class="col-12" src="<?php echo $el['img'] ?>" caracteristica="urlImagen" userId="<?php echo $el['id'] ?>" style="height: 100px; width: auto; object-fit: contain;">
								<div class="upload-btn-wrapper usuarioDato col-12 d-none" userId="<?php echo $el['id'] ?>" caracteristica="newImage" style="border: 2px dotted; position: absolute; top:0; left:0; height:100%;">
								  <button class="btn" style="opacity: 0">Upload a file</button>
								  <input sclass="newFile" type="file" style="opacity: 0;" name="myfile[]" onchange="cambiarImagen(this, <?php echo $el['id'] ?>)">
								</div>
							</div>
						</div>
						
						<div class="grid__item text-center">
							<button type="button" class="btn btn-secondary" onclick="editarUsuario(this, <?php echo $el["id"]?>)">Editar</button>
							<div class="text-center d-none m-2" caracteristica="actualizar" userId="<?php echo $el['id'] ?>">
								<button type="button" class="col-12 btn btn-primary" onclick="actualizarUsuario(<?php echo $el["id"]?>)">Actualizar</button>
								<button type="button" class="col-12 btn btn-info" onclick="actualizarUsuario()">Cancelar</button>
							</div>
						</div>
						
						<div class="grid__item text-center" caracteristica="eliminar" userId="<?php echo $el['id'] ?>">
							<button  type="button"class="btn btn-danger" onclick="eliminarUsuario(<?php echo $el['id']?>)">Eliminar</button>
						</div>
					</div>
				</form>
			<!-- </div> -->
<?php
			}
		break;
		case "cargar": 
			if(!empty($_POST['name']) || !empty($_FILES['file']['name'])){
			    $categoria = $_POST['name'];

			    $uploadedFile = '';
			    if(!empty($_FILES["file"]["type"])){
			        $fileName = time().'_'.$_FILES['file']['name'];
			        $valid_extensions = array("jpeg", "jpg", "png");
			        $temporary = explode(".", $_FILES["file"]["name"]);
			        $file_extension = end($temporary);
			        $targetPath = "uploads/categorias/".$fileName;
			    }

			    $consulta = "INSERT INTO categorias VALUES(null, '$categoria', '$targetPath')";
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
			}
		break;
		case "actualizar": 
			$categoria = $_POST['new_categoria'];
			if(isset($_POST['new_imagen'])){
				$imagen = $_POST['new_imagen'];
			}else{
				$imagen = "";
			}
			$id = $_POST['id'];

			$consulta = "UPDATE categorias SET categoria = '$categoria', img = '$imagen' WHERE id= '$id'";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			if($SQLStatement->execute()){
			}
			echo true;
		break;
		case "eliminar":
			$id = $_POST['id'];
			$consulta = "DELETE FROM categorias WHERE id= $id";
			$SQLStatement = $DBImagen->DBConexion->prepare($consulta);
			$SQLStatement->execute();
		break;
	

	}

?>