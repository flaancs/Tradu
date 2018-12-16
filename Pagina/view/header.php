<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo $f->__get("SITE_TITLE"); ?></title>
	<meta name="description" content="<?php echo $f->__get("SITE_DESCRIPTION"); ?>">
	<meta name="keywords" content="<?php echo $f->__get("SITE_KEYWORDS"); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo $f->__get("SITE_FAVICON"); ?>">
	<meta name="theme-color" content="<?php echo $f->__get("SITE_MOBILE_COLOR"); ?>">
	<!-- Materialize CSS -->
	<link rel="stylesheet" href="/assets/css/materialize.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="/assets/css/custom.css">
	<!-- Material Icons -->
	<link href="/assets/css/material-icons.css" rel="stylesheet">
	<!-- JQuery JS -->
	<script src="/assets/js/jquery.js"></script>
	<!-- Materialize JS-->
	<script src=" /assets/js/materialize.min.js"></script>
</head>
<body>
<script>
	$(function() {
		$('.sidenav').sidenav();
		$('select').formSelect();
		$('.dropdown-account').dropdown({constrainWidth: false});
		$('.modal').modal();
		$('.tooltipped').tooltip();
	});
</script>

