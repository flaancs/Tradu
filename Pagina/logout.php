<?php
	require_once("model/Config.php");

	if ($f->isLoggedUser()) {
		session_destroy();
		header("Location: /");
	} else {
		header("Location: /");
	}
?>