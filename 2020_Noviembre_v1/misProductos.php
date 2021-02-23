<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="js/funciones_propias.js"></script>
</head>
<style>
	
</style>
<body>
	<div class="container-fluid m-0 p-0">
		<div class="row m-0">
			<h1 class="order-md-2 col-12 col-md-10 bg-info m-0 py-4 text-white text-center">Mis productos</h1>
			<a href="administrador.php" class="order-md-1 py-md-0 px-0 btn btn-info col-12 col-md-2 btn_volver">
				<div class="">
					<span style="">Volver</span>
				</div>
			</a>
		</div>
		<main class="container">	
			<div class="row">	
				<a href="catNuevoProducto.php" class="col-12 p-0">
		          <button class="btn btn-info mt-3 mb-3 py-3 col-12">Cargar un producto nuevo</button>
		        </a>
			</div>


			<div id="div_productos">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 col-lg-4 p-2">
						<div class="border">
							<img class="col-12 p-0" src="https://via.placeholder.com/150X75/04F" alt="">
							<div class="col-12 text-center">
								Mesa
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 p-2">
						<div class="border">
							<img class="col-12 p-0" src="https://via.placeholder.com/150X75/04F" alt="">
							<div class="col-12 text-center">
								Cama
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 p-2">
						<div class="border">
							<img class="col-12 p-0" src="https://via.placeholder.com/150X75/04F" alt="">
							<div class="col-12 text-center">
								Silla
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 p-2">
						<div class="border">
							<img class="col-12 p-0" src="https://via.placeholder.com/150X75/04F" alt="">
							<div class="col-12 text-center">
								Etc
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
</html>