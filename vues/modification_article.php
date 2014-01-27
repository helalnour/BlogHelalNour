{include file="includes/haut.inc.php"}

	<h2>Modifier un article</h2>

	<div id="notif"><p></p></div>

	<form action="controleur.php?action=modifier_article" method="POST" enctype="multipart/form-data" id="formulaire">
		<input type="hidden" id="id_article" name="id_article" value="{$id}" />
		<div class="clearfix">
			<label for="titre">Titre : </label>
			<div class="input"><input type="text" name="titre" id="titre" value="{$titre}"/></div>
		</div>
		<div class="clearfix">
			<label for="texte">Contenu : </label>
			<div class="input"><textarea id="texte" name="texte">{$texte}</textarea></div>
		</div>
		<div class="clearfix">
			{if $image}
				<p>Image : <img src="images/{$id}.jpg"/></p>
			{/if}
			<label for="image">Nouvelle image : </label>
			<input type="file" id="image" name="image"/>
		</div>
		<div class="clearfix">
			<div class="form-actions"><input class="btn btn-large btn-primary" type="submit" value="Valider" name="valider" id="valider"/></div>
		</div>
	</form>

	{literal}
	<script type="text/javascript" >
		$(function() {
			$("#formulaire").submit(function() {
				if ($("#titre,#texte").val() === "") {
					$("#notif").removeClass();
					$("#notif").addClass("alert alert-danger");
					$("#notif>p").html("Un des champs est vide.");
					$("#notif").slideDown("slow");
					return false;
				}else{
					return true;
				}
			});
		});
	</script>
	{/literal}

{include file="includes/bas.smarty.inc.php"}