{include file="includes/haut.inc.php"}

		<h1>{$titre}</h1>
		{if $image}
			<img src="images/{$id}.jpg"/>
		{/if}
		{$texte|nl2br}<br/><br/>
		<p>Publié le {$date|date_format:"%d/%m/%Y, %H h %M"}</p>

		{if $utilisateur_connecte}
			<a href="controleur.php?action=modification_article&id={$id}" class="btn btn-primary">Modifier</a>
			<a href="controleur.php?action=supprimer_article&id={$id}" class="btn btn-primary">Supprimer</a>
			<br/><br/>
		{/if}

		<p><a href="index.php">Retour à l'accueil</a></p>

{include file="includes/bas.smarty.inc.php"}