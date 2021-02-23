<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
  include_once("coneccion.php");
  if(isset($_GET['filtro'])){
    $filtrado = $_GET['filtro'];
  }else{
    $filtrado = false;
  }

 $consulta = "SELECT * FROM productos". ($filtrado? " WHERE idCategoria = $filtrado" : "");

  $SQLServer = $handler->prepare($consulta);
  $SQLServer->execute();
  $v_productos = $SQLServer->fetchAll();
  $v_productos =array_reverse($v_productos);

  $articulos_x_pagina = 6;

  $total_articulos_db = $SQLServer->rowCount();
  $paginas = $total_articulos_db/$articulos_x_pagina;
  $paginas = ceil($paginas);
  $paginaActual = $_GET['pagina'];

  function logg( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }


  function alert( $data ){
    echo '<script>';
    echo 'alert('. json_encode( $data ) .')';
    echo '</script>';
  }

  if(!$_GET){
    header('Location: index.php?pagina=1');
  }
  if($_GET['pagina']>$paginas || $_GET['pagina']<=0){
    header("Location: index.php?pagina=1".($filtrado?'&filtro='.$filtrado:''));
  }

  $iniciar = ($paginaActual-1) * $articulos_x_pagina;

  $sql_productos = ("SELECT * FROM productos ".($filtrado? " WHERE idCategoria = $filtrado" : "")." LIMIT :iniciar,:nproductos");
  $sentencia_productos = $handler->prepare($sql_productos);
  $sentencia_productos->bindParam(':iniciar',$iniciar,PDO::PARAM_INT);
  $sentencia_productos->bindParam(':nproductos',$articulos_x_pagina,PDO::PARAM_INT);
  $sentencia_productos->execute();


  $resultado_productos = $sentencia_productos->fetchAll();
  
  
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

      <div class="container">
        <div class="filtro" id="filtro">
          <input type="checkbox" id="check" style="display:none">
            <ul>
              <!--<label for="wea"><h3><input style="display: none" type="checkbox" id="wea">Filtro</h3></label>-->
                <h3 id="abridorFiltro">Ver categorias</h3>
                <div id="lista" class="lista_oculta">
                  <?php 
                    $SQLServer = $handler->prepare("SELECT * FROM categorias");
                    $SQLServer->execute();
                    $v_categorias = $SQLServer->fetchAll();

                    foreach ($v_categorias as $i => $vc) {
                  ?>
                      <label class="label_filtro">
                        <li>
                          <input type="checkbox" idCat="<?php echo $vc["id"] ?>" nomCat="<?php echo $vc["categoria"] ?>" <?php echo ($vc["id"] == $filtrado?"checked":"") ?> onclick="filtrarCategoria(this)">
                          <span class="checkmark"><?php echo $vc["categoria"] ?></span>
                        </li>
                      </label>
                  <?php 
                    }
                  ?>
                </div>
              </ul>

        </div>

        
        <div class="container_productos">
          <?php 
          $paginasColocadas = 0;
            foreach ($v_productos as $i => $vp) {
              if($i >= $iniciar){
                if($paginasColocadas < $articulos_x_pagina){ 
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
                  $paginasColocadas++;
                }
              }
            }
          ?>

          <div class="panel_de_relleno"></div>
          <div class="panel_de_relleno"></div>
          <div class="panel_de_relleno"></div>
          <form action="producto.php" method="get" id="formIdProducto">
            <input type="hidden" name="idProducto" id="idProducto">
          </form>
          <form action="" method="get" id="formFiltro">
          </form>
        </div>
      </div>
      <nav class="nav_paginacion" style="user-select: none">
            <?php 
              $paginasDeInicio = 9;
              $desaparecerUltimo = false;
              $mayorAPaginaDeInicio = false;
              $paginasAMostrar = 8;
              $paginasAnteriores = $paginaActual - 1;
                  $temp = true;
            ?>
            <ul class="paginacion">

              <li class="<?php echo $paginaActual <= 1 ? 'disable' : '' ?>">
                <a href="index.php?pagina=<?php echo $paginaActual -1 ?><?php echo ($filtrado?"&filtro=$filtrado":"") ?>">
                <span><i class="fas fa-chevron-left"></i> Anterior</span> 
                </a>
              </li>
            <?php
              if($paginaActual >= $paginasDeInicio){
                $mayorAPaginaDeInicio = true;
            ?>
                <li class="" style="margin-right: 25px">
                  <a href="index.php?pagina=1">1</a>
                </li>
              <?php 
              }
              if($mayorAPaginaDeInicio){  
                  $paginasAnteriores = 5;
                  $paginasAMostrar = 10;
              }

              if($paginasDeInicio+1 != $paginas){

                if($mayorAPaginaDeInicio){
                  if($paginas - $paginaActual < $paginasAnteriores){
                    $paginasAnteriores = ($paginasAnteriores + $paginasAnteriores + $paginaActual - $paginas);
                    // $paginasAnteriores = $paginasAnteriores + 1;
                  }
                  if($paginas - $paginaActual < $paginasAnteriores+2){
                    $desaparecerUltimo = true; // la ultima casilla;
                  }
                }
              }

              $contadorDePaginaciones = $paginaActual - $paginasAnteriores; //por cual pagina empieza
              if($mayorAPaginaDeInicio && $paginaActual - $paginasAnteriores <= 0){
               $contadorDePaginaciones = 2; 
              }
              if($paginaActual - $contadorDePaginaciones < $paginasAnteriores){
              }
                for($i=0; $i < $paginas ; $i++):
                  if($contadorDePaginaciones<=($paginaActual+$paginasAMostrar-$paginasAnteriores) && $contadorDePaginaciones < $paginas){
              ?>
                  <?php 
                    ($contadorDePaginaciones == $paginaActual?$clickDisabled = "'pointer-events:none'": $clickDisabled="");
                  ?>
                    <li class="<?php echo $paginaActual == $contadorDePaginaciones ? 'active' : '' ?>" style="<?php echo $clickDisabled;?>">
                      <a href="index.php?pagina=<?php echo $contadorDePaginaciones ?><?php echo ($filtrado?"&filtro=$filtrado":"") ?>">
                      <?php echo $contadorDePaginaciones ?>
                      </a>
                    </li>
              <?php 
                  $contadorDePaginaciones++;
                }
                endfor  

              ?>
                <li class="<?php echo ($paginaActual == $paginas? 'active':'');?>" style="<?php echo (!$desaparecerUltimo && $paginas > $paginasAMostrar? 'margin-left: 25px':'');?>">
                  <a href="index.php?pagina=<?php echo $paginas?><?php echo ($filtrado?"&filtro=$filtrado":"") ?>">
                  <?php echo $i ?>
                  </a>
                </li>

                <li class="<?php echo $paginaActual >= $paginas ? 'disable' : '' ?>">
                  <a href="index.php?pagina=<?php echo $paginaActual +1 ?><?php echo ($filtrado?"&filtro=$filtrado":"") ?>">
                  <span>Siguiente <i class="fas fa-chevron-right"></i></span> 
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

    $("#formIdProducto").submit();
  }

  function filtrarCategoria(elemento){
    formFiltro = document.querySelector("#formFiltro")

      input = document.createElement("input")
      input.setAttribute("value", elemento.getAttribute("idCat"))  
      input.setAttribute("type", "hidden")  
      input.setAttribute("name", "filtro")
      input.setAttribute("class", "datoFiltro")  

      formFiltro.appendChild(input);

    $(formFiltro).submit();
  }


</script>
</html>
