dou = "dou"
if(typeof base_urla == 'undefined'){
    base_urla = ""
}
var bootstrap = 
[
'   <link rel=\"stylesheet\" type=\"text/css\" href=\"'+base_urla+'css/bootstrap.css\">',
'   <link rel=\"stylesheet\" type=\"text/css\" href=\"https://necolas.github.io/normalize.css/8.0.1/normalize.css\">',
'   <script type="text/javascript" src="https://kit.fontawesome.com/99853c6bfc.js" crossorigin="anonymous"></script>',
'   <meta name="viewport" content="width=device-width, initial-scale=1">',
'   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">',
'  <script type="text/javascript" src=\"'+base_urla+'js/jquery.js\"></script>',
'  <script type="text/javascript" src=\"'+base_urla+'js/jquery-ui.js\"></script>',
'  <script type="text/javascript" src=\"'+base_urla+'js/bootstrap.js\"></script>',
'  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>',
'  <link rel="stylesheet" href="'+base_urla+'css/admin_general.css"/>'
,].join('\n');

document.write(bootstrap)

function cambiar_a_coma(a){  //cualquier numero con decimal lo devolverá con coma [ej: 23433.23 => 23433,23]
  a = a.toString().replace(/\./g,',');
};

function si_no_es_numero(a){
	if(isNaN(a)){
		return "";
	}
}

function nombre_pagina_actual(a){
    urll = a.toString().substring(a.toString().lastIndexOf("/")+1,a.toString().length);
    locall = "";
	if(urll != ""){
        locall = urll;
    }else{
        locall = "index.php"
    }
    return locall
}

function dia_actual(){
    let week = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
    let dia_actual = week[new Date().getDay()];
    return dia_actual;
}

function cargar_vista(a){
	document.write("<script src=js/"+a+".js></script>")
}

function darfocus(a){
    a.setAttribute("autofocus","on");
    a.focus()
}
function sacarfocus(a){
    a.removeAttribute("autofocus");
    a.blur()
}

function acomodarFooter(){
    //para que esta funcion funcione el footer debe tener posicion absoluta y NO tener bottom 0. Esta funcion lo que hace es cambiar el tamaño del body de esa formo el footer ira abajo.
    tamaño_body_original = $(document.body).height()

    $(document.body).attr("style","height:"+$(document).height()+"px;bottom:0");

    $(window).resize(function(){
        $(document.body).attr("style","height:"+tamaño_body_original+"px; bottom:0");
        $(document.body).attr("style","height:"+$(document).height()+"px; bottom:0");
    })
}

function subirConAnimacion(){
    setTimeout(function(){
            $("html, body").stop().animate({scrollTop:"0px"}, '1000', 'swing', function() { });
    }, 20); 
}

function bajarConAnimacion(){
    setTimeout(function(){
            $("html, body").stop().animate({scrollTop:document.body.scrollHeight}, '1000', 'swing', function() { });
    }, 20); 
}

function pruebaDeMedidas(){
  //COPIAR ESTO PARA QUE FUNCIONE
  /*pruebaDeMedidas() 
    $(window).resize(function(){
        $("#linea_de_correccion").remove()
        $("#div_indicadorDeMedida").remove()
        pruebaDeMedidas()
    })*/
    linea_de_correccion = ['<div class=\"row\" id=\"linea_de_correccion\">',
'           <div style=\"margin: auto;\" class=\"col-12\">',
'               <span class=\"col-12\" style=\"background: red; display: block;\">dsasdadassa</span>',
'           </div>',
'       </div>'].join('\n');
    xs = 0;
    sm = 558;
    md = 750;
    lg = 974;
    xl = 1182;
    medidaActual = "";
    if ($(window).width() <= sm){  
        medidaActual = "es una pantalla xs"
    }
    if (($(window).width() > sm) &&  ($(window).width() <= md) ){  
        medidaActual = "es una pantalla sm"
    } 
    if (($(window).width() > md) &&  ($(window).width() <= lg) ){  
        medidaActual = "es una pantalla md"
    }  
    if (($(window).width() > lg) &&  ($(window).width() <= xl) ){  
        medidaActual = "es una pantalla lg"
    } 
    if ($(window).width() > xl){  
        medidaActual = "es una pantalla xl"
    }  
    indicadorDeMedida = document.createElement("div")
        $(indicadorDeMedida).attr("id","div_indicadorDeMedida")
        indicadorDeMedida.innerHTML = medidaActual +"\n"+$(window).width()+"px"
        $(indicadorDeMedida).attr("style","border:1px solid; display:inline-block; padding:20px; position: fixed; bottom: 120px; right: 120px; border-radius:10px; background: white")
        document.body.appendChild(indicadorDeMedida)
    document.querySelector("footer").innerHTML += linea_de_correccion
}


function input_sin_numeros(){
    $("input[name='nombre']").bind('keypress', function(event) {
        var regex = new RegExp("^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ-]$"); 
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode); 
        if (!regex.test(key)) {
            event.preventDefault(); 
            return false; 
        } 
    });
}
function input_solo_numeros(){
    $("input[name='dni']").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9]+$"); 
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode); 
        if (!regex.test(key)) {
            event.preventDefault(); 
            return false; 
        } 
    });
} 

function confirmarParaSalir(pag){
    conf  = confirm("¿Está seguro de querer salir?")
    if(conf){
        window.location.href = pag;
    }
}

