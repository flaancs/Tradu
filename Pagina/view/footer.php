<?php 
if (isset($_SESSION['GLOBAL_MSG']) && strlen($_SESSION['GLOBAL_MSG']) > 0) {
	$f->displayMsg($_SESSION['GLOBAL_MSG']);
	unset($_SESSION['GLOBAL_MSG']);
}

$db->con->close();
?>
</body>
</html>