<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
  include_once("coneccion.php");

  $SQLServer = $handler->prepare("SELECT * FROM productos");
  $SQLServer->execute();
  $v_productos = $SQLServer->fetchAll();


  $articulos_x_pagina = 9;

  $total_articulos_db = $SQLServer->rowCount();
  $paginas = $total_articulos_db/$articulos_x_pagina;
  $paginas = ceil($paginas);
 

?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/2710f1ad40.js" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>

    <?php

        include('modulos/nav.php');

     ?>
     <?php
            if(!$_GET){
              header('Location: index.php?pagina=1');
            }
            if($_GET['pagina']>$paginas || $_GET['pagina']<=0){
              header('Location: index.php?pagina=1');
            }

            $iniciar = ($_GET['pagina']-1) * $articulos_x_pagina;

            $sql_productos = ("SELECT * FROM productos LIMIT :iniciar,:nproductos");
            $sentencia_productos = $handler->prepare($sql_productos);
            $sentencia_productos->bindParam(':iniciar',$iniciar,PDO::PARAM_INT);
            $sentencia_productos->bindParam(':nproductos',$articulos_x_pagina,PDO::PARAM_INT);
            $sentencia_productos->execute();

            $resultado_productos = $sentencia_productos->fetchAll();
            
          ?>

     <nav class="nav_paginacion">

            <ul class="paginacion">

              <li class="<?php echo $_GET['pagina'] <= 1 ? 'disable' : '' ?>">
                <a href="index.php?pagina=<?php echo $_GET['pagina'] -1 ?>">
                Anterior
                </a>
              </li>

              <?php for($i=0; $i < $paginas ; $i++):?>

              <li class="<?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
                <a href="index.php?pagina=<?php echo $i+1 ?>">
                <?php echo $i+1 ?>
                </a>
              </li>

              <?php endfor  ?>

              <li class="<?php echo $_GET['pagina'] >= $paginas ? 'disable' : '' ?>">
                <a href="index.php?pagina=<?php echo $_GET['pagina'] +1 ?>">
                Siguiente
                </a>
              </li>
            </ul>
      </nav>
      <div class="container">
        <div class="filtro" id="filtro">
          <input type="checkbox" id="check" style="display:none">
            <ul>
              <!--<label for="wea"><h3><input style="display: none" type="checkbox" id="wea">Filtro</h3></label>-->
                <h3 id="abridorFiltro">Filtrar categorias</h3>
                <div id="lista" class="lista_oculta">
                  <?php 
                    $SQLServer = $handler->prepare("SELECT * FROM categorias");
                    $SQLServer->execute();
                    $v_categorias = $SQLServer->fetchAll();

                    foreach ($v_categorias as $i => $vc) {
                      echo '<label class="label_filtro"><li><input type="checkbox" idCat="'.$vc["id"].'"><span class="checkmark">'.$vc["categoria"].'</span></li></label>';
                    }
                  ?>
                </div>
              </ul>

        </div>

        
        <div class="container_productos">

          


          

          <?php 
            foreach ($resultado_productos as $i => $vp) {
              echo '
              <a onclick="irAlProducto('.$vp["id"].')" class="panel" style="cursor:pointer">
                <img src="'.$vp["img"].'" alt="'.$vp["id"].'">
                <article>
                  <p class="nombre_producto">'.$vp["producto"].'</p>
                  <p class="precio"> $'.$vp["precio"].' </p>
                  <p class="'.($vp["stock"]>0? "hay": "sin").'_stock">'.($vp["stock"]>0? "Hay Stock": "Sin Stock").'</p>
                </article>
              </a>
              ';
            }
          ?>

          <div class="panel_de_relleno"></div>
          <div class="panel_de_relleno"></div>
          <div class="panel_de_relleno"></div>
          <form action="producto.php" method="get">
            <input type="hidden" name="idProducto" id="idProducto">
          </form>
        </div>
      </div>

      <nav class="nav_paginacion">

            <ul class="paginacion">

              <li class="<?php echo $_GET['pagina'] <= 1 ? 'disable' : '' ?>">
                <a href="index.php?pagina=<?php echo $_GET['pagina'] -1 ?>">
                Anterior
                </a>
              </li>

              <?php for($i=0; $i < $paginas ; $i++):?>

              <li class="<?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>">
                <a href="index.php?pagina=<?php echo $i+1 ?>">
                <?php echo $i+1 ?>
                </a>
              </li>

              <?php endfor  ?>

              <li class="<?php echo $_GET['pagina'] >= $paginas ? 'disable' : '' ?>">
                <a href="index.php?pagina=<?php echo $_GET['pagina'] +1 ?>">
                Siguiente 
                </a>
              </li>
            </ul>
      </nav>

      <?php

        include ('modulos/footer.php')

      ?>

  </body>

  <script type="text/javascript">
  elementoAClickear = document.querySelector("#abridorFiltro")
  checkbox = document.querySelector("#check")
  elementoAClickear.onclick = function(){
    if(checkbox.checked){
       checkbox.checked = !checkbox.checked;
       document.getElementById("lista").setAttribute("class","lista_visible")
    }else{
       checkbox.checked = !checkbox.checked;
       document.getElementById("lista").setAttribute("class","lista_oculta")
    }
  }

  function irAlProducto(id){
    document.querySelector("#idProducto").value = id;

    $("form").submit();
  }


</script>
</html>
