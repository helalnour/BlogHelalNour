<?php

	function utilisateur_connecte(){
		if (isset($_SESSION['login'])) {
			return true;
		}else{
			return false;
		}
	}

	function nombre_pages(){
		$sql = 'SELECT COUNT(*) FROM articles';
		$res = mysql_query($sql);
		$res = mysql_fetch_array($res);
		$nb_articles = $res[0];
		$nb_pages = ceil($nb_articles/10);
		return $nb_pages;
	}

	function articles_page($page){
		$premier_article = ($page - 1) * 10;
		$sql = 'SELECT * FROM articles ORDER BY date DESC LIMIT '.$premier_article.', 10';
		$res = mysql_query($sql);
		$articles = array();
		while ($article = mysql_fetch_array($res)) {
			extract($article);
			array_push($articles, array('id' => $id, 'titre' => $titre, 'texte' => $texte, 'date' => $date, 'image' => $image));
		}
		return $articles;
	}

	function recherche_articles($texte){
		$sql = 'SELECT * FROM articles WHERE titre LIKE "%'.$texte.'%" OR texte LIKE "%'.$texte.'%" ORDER BY date DESC';
		$res = mysql_query($sql);
		$articles = array();
		while ($article = mysql_fetch_array($res)) {
			extract($article);
			array_push($articles, array('id' => $id, 'titre' => $titre, 'texte' => $texte, 'date' => $date, 'image' => $image));
		}
		return $articles;		
	}

	function creer_article($titre, $texte){
		$sql = 'INSERT INTO articles VALUES (0, "'.$titre.'", "'.$texte.'", UNIX_TIMESTAMP(), false)';
		$res = mysql_query($sql);
		$id = mysql_insert_id();
		return $id;
	}

	function ajouter_image_article($id, $image){
		$extensions_valides = array('jpg','jpeg');
		$extension_upload = strtolower(substr(strrchr($image['name'],'.'),1));
		if(in_array($extension_upload,$extensions_valides)){
			creer_image($image, $id);
			$sql = 'UPDATE articles SET image = true WHERE id = '.$id;
			$res = mysql_query($sql);
		}
	}

	function creer_image($image, $nomImage){
		$largeur = 200;
		$dossier = "images/";

		$imageRedimensionnee = imagecreatefromjpeg($image['tmp_name']);
		$tailleImage = getimagesize($image['tmp_name']);
		$reduction = ($largeur * 100)/$tailleImage[0];
		$hauteur = (($tailleImage[1] * $reduction)/100);
		$imageFinale = imagecreatetruecolor($largeur , $hauteur);
		imagecopyresampled($imageFinale , $imageRedimensionnee, 0, 0, 0, 0, $largeur, $hauteur, $tailleImage[0],$tailleImage[1]);
		imagejpeg($imageFinale, $dossier.$nomImage.'.jpg', 100);
	}

	function supprimer_article($id){
		$sql = 'DELETE FROM articles WHERE id = '.$id;
		$res = mysql_query($sql);
	}

	function infos_article($id){
		$sql = 'SELECT * FROM articles WHERE id = '.$id;
		$res = mysql_query($sql);
		$article = mysql_fetch_array($res);
		return $article;
	}

	function modifier_article($id, $titre, $texte){
		$sql ='UPDATE articles SET titre = "'.$titre.'", texte = "'.$texte.'", date = UNIX_TIMESTAMP() WHERE id = '.$id;
		$res = mysql_query($sql);
	}
?>