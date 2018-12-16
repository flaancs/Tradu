<?php
	//Configuración general de la página
	require_once("model/Config.php");

	//Nucleo del juego
	require_once("model/Juego.php");

	if (!$f->isLoggedUser()) {
		header("Location: /login?continue=".SED::enc("/play"));
	}

	if (isset($_GET['play'])) {
		unset($_SESSION['gameData']);
		$_SESSION['gameData'] = array('Categoria' => SED::dec($_GET['play']), 'Pregunta' => 0, 'Puntos' => 0);
		
		if (isset($_SESSION['gameData'])) {
			header("Location: /game");
		}
	}
	
	if (isset($_SESSION['gameData'])) {
		$idCategoria = $_SESSION['gameData']['Categoria'];
		$categoria = $db->con->query("SELECT * FROM categorias WHERE idCategoria = '$idCategoria'");
		$c = $categoria->fetch_assoc();
		$count = $categoria->num_rows;
		$nombre = $c['nombre'];
	}  else {
		header("Location: /play");
	}

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "Categoria {$nombre} - Jugar - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/nav.php");
	require_once("view/header.php");
	require_once("view/viewGame.php");
	require_once("view/footer.php");
?>