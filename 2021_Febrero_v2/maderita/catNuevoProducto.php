<!DOCTYPE html>
<html lang="en">
<?php 
  include_once("coneccion.php");

  $sqlConect = $handler->prepare("SELECT * FROM categorias");
  $sqlConect->execute();
  $v_categorias = $sqlConect->fetchAll();
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="js/funciones_propias.js"></script>
</head>
<style>
  .adm_panelCategoria{
    cursor: pointer;
  }
  .adm_panelCategoria:hover .border{
    border: 2px #838383 solid !important;
  }
</style>
<body>
  <div class="container-fluid m-0 p-0">
    <div class="row m-0">
      <h1 class="order-md-2 col-12 col-md-10 bg-info m-0 py-4 text-white text-center">Elegir categoría del nuevo producto</h1>
      <a href="misProductos.php" class="order-md-1 py-md-0 px-0 btn btn-info col-12 col-md-2 btn_volver">
        <div class="">
          <span style="">Volver</span>
        </div>
      </a>
    </div>
    <main class="container"> 
      <div class="row"> 
        <a href="misCategorias.php" class="col-12 p-0">
          <button class="btn btn-info mt-3 mb-3 py-3 col-12">Crear una categoría nueva</button>
        </a>
      </div> 
      <div id="div_categorias">  
        <div class="row justify-content-center">
          <?php 
            foreach ($v_categorias as $i => $vc) {
              echo '
                <div class="adm_panelCategoria col-12 col-sm-6 col-md-4 col-lg-3 col p-2" onclick="mandarIdNuevoProducto('.$vc["id"].')">
                  <div class="border">
                    <img class="col-12 p-0" src="'.$vc["img"].'">
                    <div class="col-12 text-center">
                      '.$vc["categoria"].'
                    </div>
                  </div>
                </div>
              ';
            }
          ?>
        </div>
      </div>
    </main>
    <form action="nuevoProducto.php" method="post" id="form_categoria">
      <input type="hidden" name="id_categoria" id="id_categoria">
    </form>
  </div>
</body>
<script>
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


  function mandarIdNuevoProducto(id_cat){
    document.querySelector("#id_categoria").value = id_cat;
    $("#form_categoria").submit();
  }
</script>
</html>