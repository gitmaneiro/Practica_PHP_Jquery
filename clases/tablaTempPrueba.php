<?php 
	session_start();
	require_once('conexion.php');
	
	$c= new conectar();
	$db=$c->conexion();
	
	
	$id_producto=$_POST['id_producto'];
	$id_cliente=$_POST['id_cliente'];
	
	$query="SELECT * FROM articulo WHERE id_producto=$id_producto";
	$resultado=$db->prepare($query);
	$resultado->execute();
	$producto=$resultado->fetch(PDO::FETCH_ASSOC);
	
		$id_producto=$producto['id_producto'];
		$nombre=$producto['nombre'];
		$descripcion=$producto['descripcion'];
		$precio=$producto['precio'];
	
	$query="SELECT nombre, apellido FROM clientes WHERE id_cliente=$id_cliente";
	$resultado=$db->prepare($query);
	$resultado->execute();
	$cliente=$resultado->fetch(PDO::FETCH_ASSOC);
	
		$ncliente=$cliente['nombre'].' '.$cliente['apellido'];
	
	
	$articulo=$id_producto.'||'. $nombre.'||'.$descripcion.'||'.$precio.'||'. $ncliente.'||'.$id_cliente;
	
	$_SESSION['tablaTempArticulo'][]=$articulo;
	

?>









