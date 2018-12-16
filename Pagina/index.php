<?php
	//Configuración general de la página
	require_once("model/Config.php");

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "Inicio - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/header.php");
	require_once("view/nav.php");
	require_once("view/viewHome.html");
	require_once("view/viewPuntajes.php");
	require_once("view/footer.php");
?>