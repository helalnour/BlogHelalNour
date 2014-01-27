{include file="includes/haut.inc.php"}

	<h2>{$titre}</h2>

	{foreach from=$articles item=article}
		<h1>{$article.titre}</h1>
		<p><a href="controleur.php?action=detail_article&id={$article.id}">Lire</a></p>
		{if $article.image}
			<img src="images/{$article.id}.jpg"/>
		{/if}
		{$article.texte|nl2br|truncate:300}<br/><br/>
		<p>Publié le {$article.date|date_format:"%d/%m/%Y, %H h %M"}</p>

		{if $utilisateur_connecte}
			<a href="controleur.php?action=modification_article&id={$article.id}" class="btn btn-primary">Modifier</a>
			<a href="controleur.php?action=supprimer_article&id={$article.id}" class="btn btn-primary">Supprimer</a>
			<br/><br/>
		{/if}
	{/foreach}
	{if $action == "liste"}

		<p>Pages : <a href="index.php">1 </a> 
			{for $i=1 to $nombrePages}
				{if $i == $page}
					- <a href="controleur.php?action=liste&page={$i}"><strong>{$i}</strong></a> 
				{else}
					- <a href="controleur.php?action=liste&page={$i}">{$i}</a> 
				{/if}
			{/for}
		</p>

	{/if}

{include file="includes/bas.smarty.inc.php"}