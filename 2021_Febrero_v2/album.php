<?php 
	include("coneccion.php");

	$conexAlbum = $handler->prepare("SELECT * FROM album");
	$conexAlbum->execute();
	$v_album = $conexAlbum->fetchAll();

	$dou = $handler->prepare("SELECT * FROM albumImagenes");
	$dou->execute();
	$v_albumFotos = $dou->fetchAll();

	// echo $_POST['numAlbum'];

	if(!isset($_POST['numAlbum'])){
		header("location: galeria.php");
	}else{
		for($i=0; $i<count($v_album); $i++){
			if($_POST['numAlbum'] == $v_album[$i]['id']){
				$numAlbum = $i;
			}
		}
	}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<title>Inicio</title>
	<script src="js/funciones_propias.js"></script>
	<link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" href="css/galeria.css">
	<script src="js/script_general.js"></script>
</head>
<style>
	#div_paneles{
		background: #13244f;;
		padding: 15px;
	}
	.panel_img_galeria{
		background: white;
		height: 300px;
	}
	.img_galeria{
		height: 300px;
		object-fit: cover;
		cursor: pointer;
	}
	.titulo_galeria{
		color: var(--marronCoope);
	}
	.carrusel_control{
		font-size: 50px
	}
	.modal{
		cursor: default;
	}
	.modal-img{
		width:100%;
		cursor: pointer;
	}
	.modal-content{
		background: transparent;
		border: none;
	}
</style>
<body onload="">
	<?php include("modulos/navbar.php") ?>
	<script>cargar_vista("navbar")</script>
	<?php echo "<input type='hidden' id='numAlbum' value='".$v_album[$numAlbum]['id']."'>"; ?>
	<div class="container-fluid">
	<!-- <img src="img/coop_frente.png" alt=""> -->
		<div class="cuerpo" style="height: auto;">
			<div class="" style="padding: 20px;">
				<h1 style="background: #f58634; position: relative;;  margin:0; border-radius: 20px 20px 0 0 "><span onclick="window.location.href= 'galeria.php' " style="cursor:pointer; position: absolute; left:10px; top:16px"><i class="fas flechaSalir fa-arrow-left" aria-hidden="true"></i></span><?php echo $v_album[$numAlbum]['nombre']; ?></h1>
				<h5 style="background: #f58634; margin:0"><?php echo $v_album[$numAlbum]['resumen']; ?></h5>
				<div class="col-12 douglas" style="text-align: center;">	
					<div class="row" id="div_paneles" style="justify-content: center;">		
					<?php 
						foreach ($v_albumFotos as $key => $va) {
							if($va['id_album'] == $v_album[$numAlbum]['id']){
								echo '
									<div class="col-sm-6 col-md-4 col-lg-3" style="padding:5px">
										<div style="padding:5px" class="w-100">
											<img src="'.$va["img"].'" style="background: white; padding: 0; border: none; width: 100%" class="img_galeria">
										</div>
									</div>';
							}
						}
					?>
					</div>
					<!--  -->
				</div>
			</div>
		</div>
	</div>
	<?php include("modulos/footer.php") ?>
	<script>cargar_vista("footer")</script>
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-body" style="padding: 0">
	      </div>
	    </div>
	  </div>
	</div>
</body>
<script>

	el = ""; 
	img_galeria = document.querySelectorAll(".img_galeria")
	acomodarImagenes()
	$(window).resize(function(){
		acomodarImagenes()
	})
	function acomodarImagenes(){
		if($(window).width() >= 576){	
			img_galeria.forEach(function(el){
				$(el).css("height", $(el).css("width"))
			})
		}else{
			$(el).css("height", "auto")
		}
	}

	$(document).ready(function () {
	  $(".img_galeria").click(function(){
	    var t = $(this).attr("src");
	    $(".modal-body").html("<img src='"+t+"' style='background:white; border-radius: 0.35rem' class='modal-img'>");
	    $("#myModal").modal();
	  });
	});

	$("#myModal").on("show", function () {
	  $("body").addClass("modal-open");
	  $("body").addClass("a");
	}).on("hidden", function () {
	  $("body").removeClass("modal-open")
	  $("body").removeClass("a")
	});

</script>
</html>