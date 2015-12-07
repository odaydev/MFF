//menu dépliant
$(".left-menu").on("click", function(e){
	e.preventDefault();
	$(".main-menu").stop(true).slideToggle(250);
	$(".left-menu").toggleClass("active");
});

//barre recherche
$(".fa-search").on("click", function(e){
	e.preventDefault();
	$("#search-field").stop(true).slideToggle(250);
	$("#search-icon").toggleClass("fa-search fa-times");	
});

//mini-login
$("#mini-login").on("click", function(e){
	e.preventDefault();
	$("#login").stop(true).slideToggle(250);
	$("#mini-login").toggleClass("fa-square-o fa-check-square-o");
});

var i = 0;
$('#heart').on("click",function(){
	$('#like').html(i++);
	$('#heart img').replaceWith('<img src="img/heart-icon-b.png" id="heart" alt="like" height="16" width="14"/>');
});

//Animsition
/*Transition entre les pages*/
//http://git.blivesta.com/animsition/fade-left/
$(document).ready(function() {
  $(".animsition").animsition({
    inClass: 'fade-in-down',
    outClass: 'fade-out-down',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
});

