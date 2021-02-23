 <!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
  include_once("coneccion.php");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }

    if(isset($_POST['login'])){
      if(empty($_POST['usuario']) || empty($_POST['password'])){
        $message = 'All fields are required';
      }else{
        $SQLServer = $handler->prepare("SELECT * FROM administradores WHERE usuario = :usuario AND password = :password");
        $SQLServer->execute(
          array(
            'usuario' => $_POST['usuario'],
            'password' => $_POST['password']
          )
        );
        $catFilas = $SQLServer->rowCount();
        if($catFilas > 0){
          $_SESSION['usuario'] = $_POST['usuario'];

          header("location: administrador.php");
          return true;
          $message = "bienvenido ".$_SESSION['usuario'];
        }else{
          $message = "intente nuevamente";
        }
      }
    }
    if(isset($message)){
      echo "&nbsp; $message";
    }
 ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2710f1ad40.js" crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>
    <title></title>
    <link rel="stylesheet" href="css/iniciar_sesion_style.css">
  </head>
  <body>

    <?php
      include ('modulos/nav.php');

     ?>

      
      <form class="formulario" method="post">
        <div class="fondo"></div>
        <div class="padre-presencial">
          <h1 class="formulario-titulo">Modo administrador</h1>

      		<input type="text" class="formulario-input" value="" name="usuario"><label for="" class="formulario-label">Usuario</label>
      		<input type="password" class="formulario-input" value="" name="password"><label for="" class="formulario-label">Contraseña</label>
      		<input type="submit" class="formulario-submit" name="login" value="Ingresar">
        </div>

    	</form>
    

    <?php 
      include ('modulos/footer.php');
    ?>

  </body>

  <script type="text/javascript">
//Formulario animado
var inputs = document.querySelectorAll('.formulario-input');
inputs.forEach(function(el, i){
  el.onkeyup = function(){
    if (this.value != "") {
      this.nextElementSibling.classList.add('fijar');
    }else{
      this.nextElementSibling.classList.remove('fijar');
    }
  }

  if( 1 == <?php if(isset($_SESSION['usuario'])){echo 1;}else{echo 0;}?>){
    if(el.value != ""){
      el.nextElementSibling.classList.add('fijar');
    }
  }
})





</script>
</html>
