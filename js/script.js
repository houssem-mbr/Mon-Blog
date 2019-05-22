$(function() {

	$('#contact-form').submit(function (e) {
		
		e.preventDefault();//Enlever les comportement par défaut lorsque chui en formulaire
		$('.comments').empty();//A chaque fois je veux soumettre tout le formulaire remet à zero (message d'erreur...)
		var postdata = $('#contact-form').serialize();//chercher tout les infos dans le formulaire et les mettre dans une variable postdata
		//------------------------------
		//Ajax
		//------------------------------
		$.ajax({
			type: 'POST',//type d'information
			url: 'contact.php',//de la quelle on va récupérer les informations
			data: postdata,
		   dataType:'json',
			success: function(result){   
				if (result.isSuccess) {//est-ce que le resultat envoyer par php est valider (isSuccess=true et il n'ya pas des eurreurs)  
					$('#contact-form').append("<p class='thank-you col-md-10' style='color: green;'>Votre message a bien été envoyé. Merci de m'avoir contacter <i class='far fa-smile-beam'></i></p>");
					$('#contact-form')[0].reset();
				}
				else{
					$('#firstname + .comments').html(result.firstnameError);
					$('#name + .comments').html(result.nameError);
					$('#email + .comments').html(result.emailError);
					$('#phone + .comments').html(result.phoneError);
					$('#message + .comments').html(result.messageError);
				}
			}



		});




	});




});