<?php
	//Configuración general de la página
	require_once("model/Config.php");

	if (!$f->isLoggedUser()) {
		header("Location: /login?continue=".SED::enc("/account"));
	}

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "Configuración de la cuenta - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/nav.php");
	require_once("view/header.php");
	require_once("view/viewAccount.php");
	require_once("view/footer.php");
?>