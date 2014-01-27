<?php
	
	session_start();

	include('includes/connexion.inc.php');
	include('fonctions/fonctions.php');

	include('includes/haut.inc.php');

	$sql = 'SELECT * FROM articles ORDER BY date DESC LIMIT 0, 10';
	$res = mysql_query($sql);

	while ($article = mysql_fetch_array($res)) {
		extract($article);
?>
		<h1><?= $titre ?></h1>
		<p><a href="controleur.php?action=detail_article&id=<?= $id ?>">Lire</a></p>
		<?php
			if ($image) {
				echo '<img src="images/'.$id.'.jpg"/>';
			}
		?>
		<?= nl2br($texte) ?><br/><br/>
		<p>Publié le <?= date('d/m/Y, à G:i', $date); ?></p>

		<?php
			if(utilisateur_connecte()){
				echo '<a href="controleur.php?action=modification_article&id='.$id.'" class="btn btn-primary">Modifier</a>';
				echo '<a href="controleur.php?action=supprimer_article&id='.$id.'" class="btn btn-primary">Supprimer</a>';
				echo "<br/><br/>";
			}
	}
	$nb_pages = nombre_pages();
?>
	<p>Pages : <a href="index.php"><strong>1</strong></a> - <?php for ($i=2; $i <= $nb_pages; $i++) { echo '<a href="controleur.php?action=liste&page='.$i.'">'.$i.'</a>'; } ?></p>

<?php
	include('includes/bas.inc.php');
?>