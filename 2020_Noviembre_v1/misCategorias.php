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
  /*padding:20px;*/
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
</style>
<body>
	<div class="container">
		<p class="statusMsg"></p>
		<form enctype="multipart/form-data" id="fupForm" >
			<div class="row">
			    <div class="form-group col-3">
			        <div class="imagen col-12" style="padding: 20px">
						<h4 class="text">Subir imagen</h4>
						<input type="file" class="input-file p-0" name="file" id="file">
						<img class="col-12 m-0 p-0" style="width:auto; max-width: 100%; background-color: #eeeeee; border-radius: 0.25rem" src="" alt="" >
					</div>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-12">
			    	<fieldset style="border: 1px solid;">
			        	<legend style="display: inline-block;"><label for="name">Nombre de la nueva categoria</label></legend>
			        	<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
			    	</fieldset>
			    </div>
			</div>
			<div class="row">
				<div class="col-12">
		    		<input type="submit" name="submit" class="col-12 btn btn-primary submitBtn" value="Crear categoria"/>
				</div>
			</div>
			<input type="hidden" name="accion" value="cargar">
		</form>
		<div id="info"></div>
	</div>
</body>

<script>
$(document).ready(function(e){
    $("#fupForm").on('submit', function(e){
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
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Categoría cargada correctamente.</span>');
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">La categoría no fue cargada, intente nuevamente.</span>');
                }
                $('#fupForm').css("opacity","");
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

		mostrarUsuarios();

		// function cargarUsuarios(){
		// 	var xmlhttp; //Comprobar si estas en chrome o posteriores o internet explorer
		// 	if(window.XMLHttpRequest){
		// 		xmlhttp = new XMLHttpRequest();
		// 	}else{
		// 		xmlhttp = new activeXObject("Microsoft.XMLhttp");
		// 	}

		// 	xmlhttp.onreadystatechange = function(){ 
		// 		if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
		// 			mostrarUsuarios()
		// 		}
		// 	}
		// 	var variables = "accion=cargar&";
		// 	columnas.forEach(function(col, i){
		// 		if(col != "id" && col != "img"){
		// 			variables += `${col}=${document.querySelector("#"+col).value}&`
		// 		}
		// 		if(col == "img"){
		// 			variables += `${col}=${document.querySelector("#"+col)}&`
		// 		}
		// 		console.log(variables)
		// 	})
		// 	xmlhttp.open("POST", "SQL_cargarCategoria.php", true) //metodo get, documento a agarrar, asignacion asincrona (no sera recargada);
		// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// 	xmlhttp.send(variables)
		// }

		function editarUsuario(elemento, id){
			elemento.style.opacity = "0.6"
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
				if(el.getAttribute("caracteristica") != "id"){
					el.innerHTML = `<input id="new${el.getAttribute("caracteristica")}" placeholder="${el.innerHTML}" value="${el.innerHTML}">`
				}else{
					el.style.opacity = "0.8"
					el.style.pointerEvents = "none"
				}
			})

		}

		function actualizarUsuario(id){
			if(!!id){
				confirmar = confirm("Está seguro de actualizar los datos?")
			}else{
				confirmar = false;
			}

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
				var variables = "accion=actualizar&id="+id+"&";
				columnas.forEach(function(col, i){
					if(col != "id" || document.querySelector("#new"+col).tagName != "img"){
						variables += `${col}=${document.querySelector("#new"+col).value}&`
						console.log(document.querySelector("#new"+col).tagName)
					}
				})
				xmlhttp.open("POST", "SQL_cargarCategoria.php", true) //metodo get, documento a agarrar, asignacion asincrona (no sera recargada);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send(variables)
			}else{
				mostrarUsuarios();
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