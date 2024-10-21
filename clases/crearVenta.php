<?php 

	session_start();
	
	require_once('conexion.php');
	
	$c=new conectar();
	$db=$c->conexion();
	
	
	if(isset($_SESSION['tablaTempArticulo']) && count($_SESSION['tablaTempArticulo'])>0){
		
		$query="SELECT id_venta FROM ventas group by id_venta desc";
		$resultado=$db->prepare($query);
		$resultado->execute();
		$fila=$resultado->fetch(PDO::FETCH_ASSOC);
			
		$idventa=$fila['id_venta'];
			
		if($idventa=="" || $idventa==null || $idventa==0){
			 $idventa=1;
		}else{
			$idventa=$idventa + 1;
		}
		
		
		$fecha= date('y-m-d');
		$user=10;
		$respuesta=0;
		$datos=$_SESSION['tablaTempArticulo'];
		
		
			for($i=0; $i < count($datos) ; $i++){
					$producto=explode('||', $datos[$i]);
				$query="INSERT INTO ventas (id_venta, id_cliente, id_producto, id_usuario, precio, fechaCompra) VALUES ('$idventa', '$producto[5]', '$producto[0]', '$user', '$producto[3]', '$fecha')";
				$resultado=$db->prepare($query);
				$resultado->execute();
				$respuesta=$respuesta + $resultado;
			}
			
			unset($_SESSION['tablaTempArticulo']);
			echo json_encode($respuesta);
		
		
	}else{
		echo 0;
	}
	
	
		
		
	
		


?>