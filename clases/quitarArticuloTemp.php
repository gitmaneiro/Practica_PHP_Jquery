<?php 

	session_start();
	
	$index=$_POST['index'];
	unset($_SESSION['tablaTempArticulo'][$index]);
	$datos=array_values($_SESSION['tablaTempArticulo']);
	unset($_SESSION['tablaTempArticulo']);
	$_SESSION['tablaTempArticulo']=$datos;




?>