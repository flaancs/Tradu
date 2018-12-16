<?php
	//Configuración general de la página
	require_once("model/Config.php");

	if (!$f->isLoggedUser() && !isset($_GET['user'])) {
		header("Location: /login?continue=".SED::enc("/profile"));
	}

	if (isset($_GET['user'])) {
		$title = "Perfil de {$_GET['user']}";
	} else {
        $title = "Mi perfil";
    }

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "{$title} - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/nav.php");
	require_once("view/header.php");
	require_once("view/viewProfile.php");
	require_once("view/footer.php");
?>