//Page loader
/*$(window).load(function() {
    $("#loader").fadeIn("1000");
});*/

//Error message box
$("#error-label").on('click',function(e){
    e.preventDefault();
    $(this).fadeOut(500);
});

//Burger menu
$(".left-menu").on("click", function(e){
    e.preventDefault();
    $(".main-menu").stop(true).slideToggle(250);
    $(".left-menu").toggleClass("active");
});

//Search bar
$("#search-icon").on("click", function(e){
    e.preventDefault();
    $("#search-field").stop(true).slideToggle(250);
    $("#search-icon").toggleClass("fa-search fa-times");
});

//Login menu for smartphone & tablette
$("#mini-login").on("click", function(e){
    e.preventDefault();
    $("#login").stop(true).slideToggle(250);
    $(this).toggleClass("fa-square-o fa-check-square-o");
});

//Like
var i = 0;
$('#heart').on("click",function(){
    $('#like').html(i++);
    $('#heart img').replaceWith('<img src="img/heart-icon-b.png" id="heart" alt="like" height="16" width="14"/>');
});


//Close element on document click
$(document).on('click', function(e) {

  if (!$(e.target).closest(".left-menu").length) {
    if($(".left-menu").hasClass("active")){
        closeBurgerMenu();
    }
  }else{
    return false;
  }
});

//function close top-menu
function closeBurgerMenu(){
    $(".main-menu").hide();
    $(".left-menu").removeClass("active");
}
/*
//function close login-menu
function closeLoginMenu(){
    $("#login").hide();
    $("#mini-login").removeClass("fa-check-square-o").addClass("fa-square-o");
}

//function close search
function closeSearch(){
    $("#search-field").hide();
    $("#search-icon").removeClass("fa-times").addClass("fa-search ");
}

//??
$(function() {
    $("#bt").click(function() {
        $(".box").toggleClass("box-change");
    });
});
*/

//BONUS : Konami Code




/******************  Bouton Like   ********************/
$("i[id*=hearticon]").on("click", function(){

    // $(this).toggleClass("fa-heart");
    $(this).removeClass("fa fa-heart-o");
    $(this).addClass("fa fa-heart");
    var idpost = $(this).attr('name');

    $.ajax({
         url: "ajax/req_like.php",
            dataType:'',
            data: { "idpost": idpost }
    })

    .done(function(response){
        $("i[name="+idpost+"]").next('p').html(response.like_post);
    })

    .fail(function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
            console.log(errorThrown);
        });
});
/******************  Fin Bouton Like   ********************/


/******************  Barre de recherche   ********************/
$("#search-input").on('keyup', function(){

    var kwVal = $(this).val();

    if(kwVal.length >= 2){
        $.ajax({
            url: "ajax/getposts.php",
            dataType:'',
            data: { "kw": kwVal }
        })
        .done(function( arg ) {
            var i = 0;
            $("#reslut_search").html("");
            for(value in arg){
                
                $('#reslut_search').append($('<div>').html('<a href="content.php?idpost='+arg[i].id+'">'+arg[i].title_post+'</a>'));
                i++;
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){

            console.log(textStatus);
            console.log(errorThrown);

        });

    }

});

/***  Quand on appuie sur la touche entrée  ***/
$('#search-field').on('submit',function(e){
    var key = $('#search-input').val()
    e.preventDefault();
    $(location).attr("href", "pages.php?rech="+key);
});
/****************** Fin Barre de recherche   ********************/


/****************** Pagination pages.php   ********************/
//https://github.com/luis-almeida/jPages
$(function(){

  $("div.holder").jPages({
      containerID : "pag",
      perPage      : 16,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
      endRange     : 1
  });

});
/****************** Fin Paginiation pages.php   ********************/


/****************** Scroll infinte   ********************/
//source --> http://www.arnaudbosquet.fr/developpement/comment-faire-un-infinite-scroll-en-jquery
var chaine = document.location.href;
var position = chaine.indexOf("azerty");
if(position != -1){


$(window).ready(function(){ // Quand le document est complètement chargé
    var load = false; // aucun chargement de commentaire n'est en cours

    /* la fonction offset permet de récupérer la valeur X et Y d'un élément
    dans une page. Ici on récupère la position du dernier div qui 
    a pour classe : ".commentaire" */
    var offset = $('.topics-box:last').offset();

    $(window).scroll(function(){ // On surveille l'évènement scroll
 //alert('hey');
        /* Si l'élément offset est en bas de scroll, si aucun chargement 
        n'est en cours, si le nombre de commentaire affiché est supérieur 
        à 5 et si tout les commentaires ne sont pas affichés, alors on 
        lance la fonction. */
        if((offset.top-$(window).height() <= $(window).scrollTop()) 
            && load==false && ($('.topics-box').size()>=8) && 
            ($('.topics-box').size()!=1)){

            // la valeur passe à vrai, on va charger
        load = true;

            //On récupère l'id du dernier commentaire affiché
            var last_id = $('.topics-box:last').attr('id');
            console.log(last_id);
            //On affiche un loader
            $('#loadmore').show();
            //On lance la fonction ajax
            $.ajax({
                url: './page_ajout_com.php',
                type: 'get',
                data: 'last='+last_id,

                //Succès de la requête
                success: function(data) {

                    //On masque le loader
                    $('.loadmore').fadeOut(500);
                    /* On affiche le résultat après
                    le dernier commentaire */
                    $('.topics-box:last').after(data);
                    /* On actualise la valeur offset
                    du dernier commentaire */
                    offset = $('.topics-box:last').offset();
                    //On remet la valeur à faux car c'est fini
                    $('#loadmore').hide();
                    load = false;
                }
            });
        }


    });

});
}
/****************** Fin Scroll infinte   ********************/


/****************** Animsition ******************/
/*Transition entre les pages*/
//http://git.blivesta.com/animsition/fade-left/

//down
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

//left
$(document).ready(function() {
  $(".animsition").animsition({
    inClass: 'fade-in-left',
    outClass: 'fade-out-left',
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

//right
$(document).ready(function() {
  $(".animsition").animsition({
    inClass: 'fade-in-right',
    outClass: 'fade-out-right',
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
/****************** Fin Animsition ******************/