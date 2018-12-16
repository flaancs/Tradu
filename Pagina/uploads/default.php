<?php
	header("Content-Type: image/png");
	const LARGO = 500;
	const ANCHO = 500;
	$inicial = $_GET['user'];

	$inicial = strtoupper($inicial);
	$size = 260;
	$x = 250-$size/2;
	$y = 125+$size;

	$img = imagecreate(LARGO, ANCHO);
	$bg = imagecolorallocate($img, 0, 51, 153);
	$color = imagecolorallocate($img, 255, 255, 255);
	$font = getcwd()."/ariblk.ttf";
	$texto = imagettftext($img, $size, 0, $x, $y, $color, $font, $inicial);
	imagepng($img);
	imagedestroy($img);
	
?>