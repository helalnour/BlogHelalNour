<?php
	
	session_start();

	include('includes/connexion.inc.php');
	include('fonctions/fonctions.php');
	require('smarty/Smarty.class.php');

	if (isset($_GET['action'])) {
		$action = htmlspecialchars($_GET['action']);
	}

	$smarty = new Smarty();

	switch ($action) {

		case 'liste':
			$page = htmlspecialchars($_GET['page']);
			$nb_pages = nombre_pages();
			$articles = articles_page($page);
			$titre = 'page '.$page;
			$smarty->assign(array('action' => $action, 'page' => $page, 'nb_pages' => $nb_pages, 'articles' => $articles, 'titre' => $titre, 'utilisateur_connecte' => utilisateur_connecte()));
			$vue = 'liste.php';
		break;

		case 'recherche':
			$texte = htmlspecialchars($_GET['texte']);
			$articles = recherche_articles($texte);
			$titre = 'Recherche de '.$texte;
			$smarty->assign(array('action' => $action, 'texte' => $texte, 'articles' => $articles, 'titre' => $titre, 'utilisateur_connecte' => utilisateur_connecte()));
			$vue = 'liste.php';
		break;
		
		case 'ecrire_article':
			include('vues/nouvel_article.php');
		break;

		case 'creer_article':
			$titre = htmlspecialchars($_POST['titre']);
			$texte = htmlspecialchars($_POST['texte']);
			$id = creer_article($titre, $texte);
			if (isset($_FILES['image'])) {
				$image = $_FILES['image'];
				ajouter_image_article($id, $image);
			}
			header("location:index.php");
			exit();
		break;

		case 'supprimer_article':
			$id = htmlspecialchars($_GET['id']);
			supprimer_article($id);
			header("location:index.php");
			exit();
		break;

		case 'modification_article':
			$id = htmlspecialchars($_GET['id']);
			$article = infos_article($id);
			extract($article);
			$smarty->assign(array('id' => $id, 'titre' => $titre, 'texte' => $texte, 'date' => $date, 'image' => $image, 'utilisateur_connecte' => utilisateur_connecte()));
			$vue = 'modification_article.php';
		break;

		case 'modifier_article':
			$id = htmlspecialchars($_POST['id_article']);
			$titre = htmlspecialchars($_POST['titre']);
			$texte = htmlspecialchars($_POST['texte']);
			modifier_article($id, $titre, $texte);
			if (isset($_FILES['image'])) {
				$image = $_FILES['image'];
				ajouter_image_article($id, $image);
			}
			header("location:index.php");
			exit();
		break;

		case 'detail_article':
			$id = htmlspecialchars($_GET['id']);
			$article = infos_article($id);
			extract($article);
			$smarty->assign(array('id' => $id, 'titre' => $titre, 'texte' => $texte, 'date' => $date, 'image' => $image, 'utilisateur_connecte' => utilisateur_connecte()));
			$vue = 'detail_article.php';
		break;

	}

	$smarty->display('vues/'.$vue);

?>