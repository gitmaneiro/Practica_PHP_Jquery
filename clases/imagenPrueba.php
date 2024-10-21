<?php 

	if(!empty($_FILES['imagen'])){
		$nombre_imagen=$_FILES['imagen']['name'];
		
		$carpeta_destino='../serverImg/';
		
		move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);
		
		
	}else{
		echo 'no esta llegando la imagen';
	}


?>