<?php
	//Configuración general de la página
	require_once("model/Config.php");
	require_once("model/Usuario.php");
	require_once("model/Perfil.php");
	$u = new Usuario();

	if (Perfil::checkProfile() || !$f->isLoggedUser()) {
		header("Location: /");
	}

	//Setter para las variables de la página
	$f->__set("SITE_TITLE", "Crear perfil - ".$f->__get("SITE_NAME"));
	$f->__set("SITE_DESCRIPTION", "Descripcion generica");
	$f->__set("SITE_KEYWORDS", "Keywords");

	//Vistas
	require_once("view/header.php");
	require_once("view/viewCreateprofile.html");
	require_once("view/footer.php");
?>