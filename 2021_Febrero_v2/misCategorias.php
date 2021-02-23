<!DOCTYPE html>
<html lang="en">
<?php 
	require_once("coneccion.php");

	$rs = $handler->query('SELECT * FROM categorias LIMIT 0');
	for ($i = 0; $i < $rs->columnCount(); $i++) {
		$col = $rs->getColumnMeta($i);
		$columns[] = $col['name'];
	}

?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link rel="stylesheet" href="css/tablaFlex.css">
	<title>Document</title>
</head>
<script>var columnas = <?php echo json_encode($columns); ?> </script>
<style>
	body{
		padding: 20px
	}
	.imagen {
	  max-width: 100%;
	  background:#eeeeee;
	  text-align: center;
	  border: 1px solid gray;
	  z-index:0;
	  border-radius: 8px;
	  box-sizing: border-box;
	  justify-content: center;
	}

	.imagen > .text  {
	  margin: 0;
	  position: absolute;
	  z-index:-1;
	  cursor:pointer;
	}

	 .imagen > .input-file {
	  position:absolute;
	   left:0;
	  width: 100%;
	  height:100%;
	  opacity: 0;
	  cursor:pointer;
	  z-index:3; 
	}

	.imagen > .img-imagen{
	  width: 100%;
	  height:100%;
	  z-index:2;
	  border: none;
	  border-radius: 5px;
	  padding: 3px;
	}

	.del-imagen{
	  display:none;
	}

	.img-imagen:hover > .del-imagen {
	  position: absolute;
	  float: left;
	  z-index:4;
	  border: 1px solid red;
	  border-radius:5px;
	  display:block;
	}

	.upload-btn-wrapper {
	  position: relative;
	  overflow: hidden;
	  display: inline-block;
	}

	.upload-btn-wrapper input[type=file] {
	  font-size: 100px;
	  position: absolute;
	  left: 0;
	  top: 0;
	  opacity: 0;
	}
</style>
<body>
	<main class="container">  
		<div class="row">
			<form enctype="multipart/form-data" id="formCategoria" class="col-12 p-3" style="border-radius: 0.25rem; background: #CBF7F0">  
				<div class="row p-0 m-0 mb-3" >
				  <div class="imagen col-12" style="padding: 20px; background: white">
				      <h4 class="text col-12">Subir imagen</h4>
				      <input type="file" name="file" id="file" class="input-file p-0 col-12" style="position: absolute; top:0; left: 0;" required="">
				      <img class="col-12 col-md-3 m-0 p-0" style="width:auto; border-radius: 0.25rem;" src="" alt="" >
				  </div>
				</div>
				<div class="row p-0 m-0 mb-3">
				  <label for="name" class="col-12 p-0 m-0"><span>ingrese el nombre del nuevo producto:</span>
				    <input type="text" id="name" name="name" class="form-control col-12" placeholder="" required="" autocomplete="off">
				  </label>
				</div>
				<div class="row p-0 m-0 mb-3">
		          <label for="" class="col-12 p-0 m-0">
		            <div class="row p-0 m-0">
		              <input type="submit" name="submit" class="col-12 btn btn-info submitBtn" value="Crear categoria"/>
		            </div>
		          </label>
		        </div>
				<input type="hidden" name="accion" value="cargar">
			</form>
		</div>
		<div class="row p-0">	
			<div id="info" class="col-12 mt-4 p-0"></div>
		</div>
	</main>
</body>


<script>
$(document).ready(function(e){
    $("#formCategoria").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'SQL_cargarCategoria.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#formCategoria').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#formCategoria')[0].reset();
                }else{
                }
                $('#formCategoria').css("opacity","");
                $(".submitBtn").removeAttr("disabled");

                mostrarUsuarios();
            }
        });
    });
   

    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
});
	window.addEventListener('load', function() {
	    document.querySelector('input[type="file"]').addEventListener('change', function() {
		    if(this.files && this.files[0]) {
		      var img = document.querySelector('img');  // $('img')[0]
		      img.src = URL.createObjectURL(this.files[0]); // set src to blob url
		      document.querySelector(".text").innerHTML = ""
		      document.querySelector(".imagen").setAttribute("style", "padding: 0px")       
		    }
		});
	});	
</script>
<script>
	// $(document).ready(function(){

		var info = document.querySelector("#info")
		// function ajax_get_json(){



		function mostrarUsuarios(){
			var xmlhttp; //Comprobar si estas en chrome o posteriores o internet explorer
			if(window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
			}else{
				xmlhttp = new activeXObject("Microsoft.XMLhttp");
			}
			xmlhttp.onreadystatechange = function(){ 
				if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
					info.innerHTML = xmlhttp.responseText;
				}
			}
			var variables = "accion=mostrar&";
			xmlhttp.open("POST", "SQL_cargarCategoria.php", true) //metodo get, documento a agarrar, asignacion asincrona (no sera recargada);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(variables)
		}

		function cambiarImagen(file, id){
			img = document.querySelector("img[userId='"+id+"']")
			if(file.files.length > 0){
				img.src = URL.createObjectURL(file.files[0]);
				// document.querySelector("#nueva_imagen").value = file.files[0].name;
			}
		}

		mostrarUsuarios();

		function editarUsuario(elemento, id){
			$(elemento).addClass("d-none");
			elemento.style.pointerEvents = "none"
			v_inputs = [];

			document.querySelectorAll(".usuarioDato").forEach(function(el, i){
				if(el.getAttribute("userId") == id){
					v_inputs.push(el);
				}else{
					el.parentNode.style.opacity = "0.3"
					el.parentNode.style.pointerEvents = "none"
				}
			})
			document.querySelectorAll("[caracteristica='actualizar']").forEach(function(el, i){
				if(el.getAttribute("userId") == id){
					$(el).removeClass("d-none")
				}
			})
			document.querySelectorAll("[caracteristica='cancelar']").forEach(function(el, i){
				if(el.getAttribute("userId") == id){
					$(el).removeClass("d-none")
				}
			})
			document.querySelectorAll("[caracteristica='eliminar']").forEach(function(el, i){
				if(el.getAttribute("userId") == id){
					el.style.opacity = "0.8"
					el.style.pointerEvents = "none"
				}
			})
			v_inputs.forEach(function(el, i){
				if(el.getAttribute("caracteristica") != "id" && el.getAttribute("caracteristica") != "imagen" && el.getAttribute("caracteristica") != "newImage" && el.getAttribute("caracteristica") != "urlImage"){
					el.innerHTML = `<input class="form-control" name="new_${el.getAttribute("caracteristica")}" placeholder="${el.innerHTML}" value="${el.innerHTML}">`
				}else{
					el.style.opacity = "0.8"
				}

				if(el.getAttribute("caracteristica") == "newImage"){
					$(el).removeClass("d-none")				
				}
			})

		}

		function actualizarUsuario(id){
			if(!!id){
			Swal.fire({
			  title: '¿Desea enviar su respuesta?',
			  text: "El usuario podra verla desde la pagina del producto",
			  icon: 'question',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Enviar respuesta',
			  cancelButtonText: 'Cancelar'
			})
			.then((result) => {
				if (result.isConfirmed) {
					data = $("#formNewData"+id).serializeArray();
					data.push(
						{name: 'accion', value: 'actualizar'},
						{name: 'id', value: id},
					)
					console.log(data);
					$.ajax({
					    url: 'SQL_cargarCategoria.php',
					    type: 'post',
					    dataType: 'json',
					    data: data,
					    beforeSend: function(){
					        $('.submitBtn').attr("disabled","disabled");
					        $('#formConsulta').css("opacity",".5");
							mostrarUsuarios();
					    },
					})
					.done(function(){
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
						})
						Toast.fire({
							icon: 'success',
							title: 'Los datos han sido actualizados correctamente',
							didOpen: () => {
								mostrarUsuarios();
							}
						})
					})
					.fail(function(){
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
						})
						Toast.fire({
						  icon: 'error',
						  title: 'Error actualizar los datos, intente nuevamente',
						})
					})
				}else{
					mostrarUsuarios();
				}
			})
			}else{
				mostrarUsuarios()
			}
		}

		function eliminarUsuario(id){
			confirmar = confirm("Está seguro de eliminar al usuario")
			if(confirmar){
				var xmlhttp; //Comprobar si estas en chrome o posteriores o internet explorer
				if(window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();
				}else{
					xmlhttp = new activeXObject("Microsoft.XMLhttp");
				}

				xmlhttp.onreadystatechange = function(){ 
					if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
						mostrarUsuarios();
					}
				}
				var variables = "accion=eliminar&id="+id+"&";
				xmlhttp.open("POST", "SQL_cargarCategoria.php", true) //metodo get, documento a agarrar, asignacion asincrona (no sera recargada);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send(variables)
			}
		}

		// }
	// })
</script>
</html>