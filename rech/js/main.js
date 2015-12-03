//on va déclencher notre code à chaque touche tapée
$("#kw-input").on('keyup', function(){

	//récupère ce qu'a tapé l'internaute
	var kwVal = $(this).val();

	//minimum 3 caractères pour faire une requête ajax (sinon ça vaut pas le coup)
	if (kwVal.length < 3){
		//si c'est moins que 3 caractères, on efface l'éventuel contenu précédemment affiché
		$("#posts-container").html("");
	}
	else {
		//on lance notre requête, en GET. 
		$.ajax({
			"url": "ajax/getposts.php",
			"type": "GET",
			"data": {
				"kw": kwVal //on envoit le mot-clef au serveur pour qu'il le cherche dans la bdd
			}
		})
		//quand on recoit la réponse...
		.done(function(response){
			//on l'injecte dans notre balise prévue à cet effet
			$("#posts-container").html(response);
		})
		.fail(function(){
			alert("Erreur !");
		});
	}
});