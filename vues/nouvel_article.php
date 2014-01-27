<?php
	include('includes/haut.inc.php');
?>

	<h2>Nouvel article</h2>

	<div id="notif"><p></p></div>

	<form action="controleur.php?action=creer_article" method="POST" enctype="multipart/form-data" id="formulaire">
		<div class="clearfix">
			<label for="titre">Titre : </label>
			<div class="input"><input type="text" name="titre" id="titre" /></div>
		</div>
		<div class="clearfix">
			<label for="texte">Contenu : </label>
			<div class="input"><textarea id="texte" name="texte"></textarea></div>
		</div>
		<div class="clearfix">
			<label for="image">Image : </label>
			<input type="file" id="image" name="image"/>
		</div>
		<div class="clearfix">
			<div class="form-actions"><input class="btn btn-large btn-primary" type="submit" value="Valider" name="valider" id="valider"/></div>
		</div>
	</form>

	<script type="text/javascript" >
		$(function() {
			$("#formulaire").submit(function() {
				if ($("#titre,#texte").val() === "") {
					$("#notif").removeClass();
					$("#notif").addClass("alert alert-danger");
					$("#notif>p").html("Un des champs est vide");
					$("#notif").slideDown("slow");
					return false;
				}else{
					return true;
				}
			});
		});
	</script>
<?php
	include('includes/bas.inc.php');
?>