$(function() {

	$('#comments-form').submit(function (e) {
		
		e.preventDefault();//Enlever les comportement par défaut lorsque chui en formulaire
		$('.comments').empty();//A chaque fois je veux soumettre tout le formulaire remet à zero (message d'erreur...)
		var postdata = $('#comments-form').serialize();//chercher tout les infos dans le formulaire et les mettre dans une variable postdata
		//------------------------------
		//Ajax
		//------------------------------
		$.ajax({
			type: 'POST',//type d'information
			url: '../article.php',//de la quelle on va récupérer les informations
			data: postdata,
			dataType: 'json',
			success: function(result){

				if (result.isSuccess) {//est-ce que le resultat envoyer par php est valider (isSuccess=true et il n'ya pas des eurreurs)  
					$('.thx').append("<p class='thank-you col-md-10' style='color: green;'>Votre commentaire a bien été publier.<i class='far fa-smile-beam'></i></p>");
					$('#comments-form')[0].reset();
				}
				else{
					
					$('#author + .comments').html(result.authorerr);
					$('#comment + .comments').html(result.commenterr);
					
				}
			}



		});




	});




});