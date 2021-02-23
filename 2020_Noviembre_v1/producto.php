<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
  include_once("coneccion.php");

  $SQLServer = $handler->prepare("SELECT * FROM productos");
  $SQLServer->execute();
  $v_productos = $SQLServer->fetchAll();
  if(isset($_GET['idProducto'])){
    $idProducto = $_GET['idProducto'];
    foreach ($v_productos as $i => $vp) {
      if($_GET['idProducto'] == $vp["id"]){
        $posProducto = $i;
      }
    }
  }else{
    header("location: index.php");
  }
?>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/producto.css">
    <link rel="stylesheet" href="css/nav_style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>

    <?php
      include ('modulos/nav.php');
    ?>

    <div class="container_producto">

      <div class="imagen_producto">
          <img src='<?php echo $v_productos[$posProducto]["img"]?>'/>
      </div>
      <div class="descripcion_producto">
          <label class="nombre_producto"><?php echo $v_productos[$posProducto]["producto"]?></label>
          <label class="precio">$<?php echo $v_productos[$posProducto]["precio"]?></label>

          <article class="descripcion">
            <h3>Descripcion:</h3>
            <pre><?php echo $v_productos[$posProducto]["descripcion"]?></pre>

            <p class="acotacion"><?php echo $v_productos[$posProducto]["acotacion"]?></p>

          </article>
          <label class="divisor"></label>

            <label class="stock">Disponible: <?php echo $v_productos[$posProducto]["stock"]?></label>
      </div>

    </div>
    <div class="comentarios_container">
      <div class="panel_comentarios">
            <h3 class="titulo_general">Preguntas y respuestas</h3>
            <div class="divisor_2"></div>
            <div class="formular_pregunta">
                <h3 class="titulo_pregunta">Preguntale al vendedor:</h3>
                <form class="formulario" id="formConsulta" method="post">
                    <textarea placeholder="Escribí tu pregunta..." id="pregText" autocomplete="off"></textarea>
                    <input type="hidden" name="pregunta">
                    <input type="hidden" name="idProd" value=" <?php echo $_GET['idProducto']; ?> ">
                    <input class="boton_enviar submitBtn" type="submit" name="submit" id="submit" value="Enviar pregunta"></input>
                </form>
            </div>
            <div id="divPreguntas">
              <?php 

                $SQLServer = $handler->prepare("SELECT * FROM consultas");
                $SQLServer->execute();
                $v_consultas = $SQLServer->fetchAll();
                $cantidadDeRespuestas = 0;
                foreach ($v_consultas as $key => $vc) {
                    if($vc["respuesta"]!=""){
                  if($idProducto == $vc['idProducto']){
                      echo '
                        <div class="preguntas">
                          <p class="pregunta_usuario">'.$vc["pregunta"].'</p>
                          <p class="respuesta_admin">'.$vc["respuesta"].'</p>
                      ';
                      $cantidadDeRespuestas++;
                    }
                  }
                }

                if($cantidadDeRespuestas == 0){
                  echo "<br><span style='color:grey'>No hay consultas, haz la tuya</span>";
                }
              ?>
            </div>
        </div>
    </div>
  </div>
    <?php 
      include ('modulos/footer.php');
    ?>

  </body>
  <script>  
    $("#formConsulta").on('submit', function(e){
        e.preventDefault();
        document.querySelector(`[name='pregunta']`).value = document.querySelector("#pregText").value
        $.ajax({
            type: 'POST',
            url: 'SQL_nuevaConsulta.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#formConsulta').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#formConsulta')[0].reset();
                    swal("¡Pregunta Enviada!", "Cuando el vendedor vea su pregunta será respondida", "success");
                }else{
                    swal("¡Algo salió mal!", "La pregunta no pudo ser enviada, por favor intente nuevamente", "error");
                }
                $('#formConsulta').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });

  </script> 
</html>
