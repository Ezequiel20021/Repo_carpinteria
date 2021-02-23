let pags = [];
var paginas = document.querySelectorAll(".titulo_nav")
for(let i=0; i<paginas.length; i++){
	pags.push(paginas[i].getAttribute("href"))
}

for(let i = 0; i < pags.length ; i++){
	if((location.href).includes(document.querySelector("#nombre_pagina").getAttribute("value")) && document.querySelector("#nombre_pagina").getAttribute("value").includes(pags[i])){
		console.log(pags[i])
		//let clase= paginas[0].getAttribute("class")
		pagina__actual = i;
		/*paginas.forEach(function(el2){
		  el2.setattribute("class",clase);
		})*/
		paginas[pagina__actual].setAttribute("id","this")
		// paginas[]
	}
}


/*$(document).ready(function(){
	$('.menu-toggle').click(function(){
		$('nav').toggleClass('active');
	})
})

//nav

menu_icon = document.querySelector(".menu_icon");
check_menu = document.querySelector("#check_menu")
menu_abrir = document.querySelectorAll(".menu_abrir");


check_menu.onclick = function(){

  if(check_menu.checked){
    menu_abrir.forEach((item, i) => {
      item.style.display = "block";
    });
  }else{
    menu_abrir.forEach((item, i) => {
      item.style.display = "none";
    });
  }
}

$(window).resize(function(){

  if($(window).width() >= 1080){

    menu_abrir.forEach((item, i) => {
      item.style.display = "block";
    });

  }else{
    menu_abrir.forEach((item, i) => {
      item.style.display = "none";
    });

  }

});
*/
