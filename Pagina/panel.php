<?php
	//Configuración general de la página
	require_once("model/Config.php");

	if (!$f->isLoggedAdmin()) {
		header("Location: /");
	}

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "Panel de administracion - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/nav.php");
	require_once("view/header.php");
	require_once("view/viewAdminPanel.php");
	require_once("view/footer.php");
?>