<!DOCTYPE html>
<?php

  session_start();
  include_once("coneccion.php");
  
  if(empty($_SESSION['usuario'])){
    header("location: iniciar_sesion.php");
  }
  $SQLServer = $handler->prepare("SELECT * FROM categorias");
  $SQLServer->execute();
  $v_categorias = $SQLServer->fetchAll();

  if(isset($_POST['id_categoria'])){
    foreach ($v_categorias as $i => $vc) {
      if($_POST['id_categoria'] == $vc["id"]){
        $idCat = $i;
      }
    }
  }else{
    header("location: catNuevoProducto.php");
  }

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="js/funciones_propias.js"></script>
</head>
<style>
  .imagen {
  max-width: 100%;
  text-align: center;
  z-index:0;
  border-radius: 8px;
  box-sizing: border-box;
  justify-content: center;
  cursor:pointer;
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
  <div class="container-fluid m-0 p-0">
    <div class="row m-0">
      <h1 class="order-md-2 col-12 col-md-10 bg-info m-0 py-4 text-white text-center">Cargar nuevo producto: <?php echo $v_categorias[$idCat]["categoria"];?></h1>
      <a href="#" onclick="confirmarParaSalir('catNuevoProducto.php')" class="order-md-1 py-md-0 px-0 btn btn-info col-12 col-md-2 btn_volver">
        <div class="">
          <span style="">Volver</span>
        </div>
      </a>
    </div>
    <main class="container">  
      <div class="row">
      <form enctype="multipart/form-data" id="formContacto" class="col-12 p-3" style="border-radius: 0.25rem; background: #CBF7F0">  
        <div class="row p-0 m-0 mb-3" >
          <div class="imagen col-12" style="padding: 20px; background: white">
              <h4 class="text col-12">Subir imagen</h4>
              <input type="file" name="file" id="file" class="input-file p-0 col-12" style="position: absolute; top:0; left: 0;" required="">
              <img class="col-12 col-md-3 m-0 p-0" style="width:auto; border-radius: 0.25rem;" src="" alt="" >
          </div>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="producto" class="col-12 p-0 m-0"><span>ingrese el nombre del nuevo producto:</span>
            <input type="text" id="producto" name="producto" class="form-control col-12" placeholder="" required="" autocomplete="off">
          </label>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="descripcion" class="col-12 p-0 m-0"><span>ingrese una descripción para el nuevo producto:</span>
            <input type="hidden"  name="descripcion" class="form-control col-12" placeholder="" required="">
            <textarea contenteditable="" id="descripcion" style="background: white; cursor: text; resize:none;min-height: 160px; height: auto;" class="m-0 col-12 form-control" onkeyup="document.querySelector(`[name='descripcion']`).value = this.value" required=""></textarea>
          </label>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="acotacion" class="col-12 p-0 m-0"><span>ingrese una acotacion para el nuevo producto:</span>
            <input type="hidden"  name="acotacion" class="form-control col-12" placeholder="">
            <textarea id="acotacion" style="background: white; cursor: text;min-height: 100px; height: auto; resize: none;" class="col-12 form-control" onkeyup="document.querySelector(`[name='acotacion']`).value = this.value" required=""></textarea>
          </label>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="precio" class="col-12 p-0 m-0"><span>ingrese el precio del nuevo producto:</span>
            <input type="number" id="precio" name="precio" step="0.01" class="form-control col-12" placeholder="" onkeyup="document.querySelector(`#precioP`).innerHTML = 'El precio escogido es: '+NumeroALetras(this.value)" required="">
            <p id="precioP" class="m-0">&nbsp;</p>
          </label>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="stock" class="col-12 p-0 m-0"><span>ingrese el stock del producto:</span>
            <input type="text" id="stock" name="stock" class="form-control col-12" placeholder="" required="" autocomplete="off">
          </label>
        </div>
        <div class="row p-0 m-0 mb-3">
          <label for="" class="col-12 p-0 m-0">
            <div class="row p-0 m-0">
              <input type="submit" name="submit" class="col-12 col-md-6 btn btn-info submitBtn" value="Crear producto"/>
              <input type="button" name="submit" class="col-12 col-md-6 btn btn-secondary" value="Ver vista previa"/>
            </div>
          </label>
        </div>
        <input type="hidden" name="accion" value="cargar">
        <input type="hidden" name="id_categoria" value="<?php echo $_POST['id_categoria'] ?>">
      </form>
      </div>
    </main>
  </div>
</body>
<script>
  $(document).ready(function(e){
    $("#formContacto").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'SQL_cargarProducto.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#formContacto').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#formContacto')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Categoría cargada correctamente.</span>');
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">La categoría no fue cargada, intente nuevamente.</span>');
                }
                $('#formContacto').css("opacity","");
                $(".submitBtn").removeAttr("disabled");

                // mostrarUsuarios();
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

  function confirmarParaSalir(pag){
    conf  = confirm("¿Está seguro de querer salir?")
    if(conf){
      window.location.href = pag;
    }
  }

  function Unidades(num){
 
  switch(num)
  {
    case 1: return "un";
    case 2: return "dos";
    case 3: return "tres";
    case 4: return "cuatro";
    case 5: return "cinco";
    case 6: return "seis";
    case 7: return "siete";
    case 8: return "ocho";
    case 9: return "nueve";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "diez";
        case 1: return "once";
        case 2: return "doce";
        case 3: return "trece";
        case 4: return "catorce";
        case 5: return "quince";
        default: return "dieci" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "veinte";
        default: return "veinti" + Unidades(unidad);
      }
    case 3: return DecenasY("treinta", unidad);
    case 4: return DecenasY("cuarenta", unidad);
    case 5: return DecenasY("cincuenta", unidad);
    case 6: return DecenasY("sesenta", unidad);
    case 7: return DecenasY("setenta", unidad);
    case 8: return DecenasY("ochenta", unidad);
    case 9: return DecenasY("noventa", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "ciento " + Decenas(decenas);
      return "cien";
    case 2: return "doscientos " + Decenas(decenas);
    case 3: return "trescientos " + Decenas(decenas);
    case 4: return "cuatrocientos " + Decenas(decenas);
    case 5: return "quinientos " + Decenas(decenas);
    case 6: return "seiscientos " + Decenas(decenas);
    case 7: return "setecientos " + Decenas(decenas);
    case 8: return "ochocientos " + Decenas(decenas);
    case 9: return "novecientos " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "mil", "mil");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "un millon", "millones");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="pesos";
    data.letrasMonedaSingular="peso";
  }else{
    data.letrasMonedaPlural="centavos";
    data.letrasMonedaSingular="centavo";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = "con " + NumeroALetras(data.centavos,true);
 
  if(data.enteros == 0)
    return "cero " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()
</script>
</html>