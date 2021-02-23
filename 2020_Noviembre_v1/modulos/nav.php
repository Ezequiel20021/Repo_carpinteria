<!DOCTYPE html>
<html>
<head>
	<title>Navbar prueba 2</title>
	<link rel="stylesheet" type="text/css" href="./css/	navbar_2.css">

	<script src="https://kit.fontawesome.com/2710f1ad40.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/nav_this.js"></script>
</head>
<body>

	<header class="header_navbar">
		<label class="nav_title">
			<a href="index.php">
				<h1>Carpinteria Salazar</h1>
				<p>Mostrador digital</p>
			</a>
		</label>	
		<input type="checkbox" id="toggle_check" style="display: none">

		<label for="toggle_check" id="lable_check" class="icon_menu">
			<i class="fas fa-bars"></i>
		</label>
		<nav class="nav_head">				
			<ul>
				
				<a class="titulo_nav" href="index.php"><label class="item_check"><li>Productos</li></label></a>
				<a class="titulo_nav" href="quienes_somos.php"><label class="item_check"><li>¿Quienes somos?</li></label></a>
				<a class="titulo_nav" href="ubicacion_contacto.php"><label class="item_check"><li>Ubicacion</li></label></a>
				<a class="titulo_nav" href="iniciar_sesion.php"><label class="item_check"><li>Modo administrador</li></label></a>

			</ul>
		</nav>
	</header>

	<script src="./js/navbar.js"></script>

</body>
</html>