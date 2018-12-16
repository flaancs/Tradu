<?php
	require_once("Conexion.php");
	require_once("GlobalFuncs.php");
	require_once("SED.php");

	session_start();
	date_default_timezone_set("America/Punta_Arenas");
	$db = new Conexion();
	$f = new GlobalFuncs();

	//Configuración de la página
	$f->__set("SITE_NAME", "Traduseñas");
	$f->__set("SITE_LOGO", "Traduseñas");
	$f->__set("SITE_DEBUG", true);
	$f->__set("SITE_MAINTENANCE", false);
	$f->__set("SITE_MOBILE_COLOR", "#000000");
	$f->__set("SITE_FAVICON", "");

	//Redirección en caso de que el sitio se encuentre en mantenimiento
	if ($f->__get("SITE_MAINTENANCE")) {
		header("Location: /maintenance");
	}

	//En caso de que el sitio esté en modo debug se mostrarán todos los errores
	if ($f->__get("SITE_DEBUG")) {
		error_reporting(E_ALL);
	} else {
		error_reporting(0);
	}
?>