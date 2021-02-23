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
var a = document.write('<input type="hidden" id="nombre_pagina" value="'+nombre_pagina_actual(window.location)+'">')
