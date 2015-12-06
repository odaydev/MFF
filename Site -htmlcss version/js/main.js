//menu dépliant
$(".left-menu").on("click", function(e){
	e.preventDefault();
	$(".main-menu").stop(true).slideToggle(250);
	$(".left-menu").toggleClass("fa-bars fa-times");
});

//barre recherche
$(".fa-search").on("click", function(e){
	e.preventDefault();
	$("#search-field").stop(true).slideToggle(250);
	$("#search-icon").toggleClass("fa-search fa-times");		
});