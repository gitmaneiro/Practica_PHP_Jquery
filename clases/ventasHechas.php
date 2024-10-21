<?php 

	require_once('conexion.php');
	
	
	class tablaVentas extends conectar {
		
		private $db;
		
		public function __construct(){
			$this->db=conectar::conexion();
		}
		
		
		public function nombreCliente($id_cliente){
			$query="SELECT nombre, apellido FROM clientes WHERE id_cliente=$id_cliente";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			$cliente=$resultado->fetch(PDO::FETCH_ASSOC);
			
			$ncliente=$cliente['nombre'].' '.$cliente['apellido'];
			
			return $ncliente;
			
		}
		
		
		public function obtenerTotal($id_venta){
			$total=0;
			$query="SELECT precio FROM ventas WHERE id_venta=$id_venta";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$total=$total+$fila['precio'];
			}
			
			return $total;
			
		}
		
		
		
	} ///end class





?>