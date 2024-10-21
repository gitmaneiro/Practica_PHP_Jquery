<?php 

	require_once('conexion.php');
	
	class vender extends conectar{
		
		private $db;
		
		public function __construct(){
			$this->db=conectar::conexion();
			
		}
		
		
		public function selectCliente(){
			$json=array();
			$query="SELECT * FROM clientes";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_cliente'=>$fila['id_cliente'],
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido']
				);
			}
			
			return json_encode($json);
			
		}
		
		
		
		public function selectProducto(){
			$json=array();
			$query="SELECT id_producto, nombre, descripcion FROM articulo";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_producto'=>$fila['id_producto'],
					'nombre'=>$fila['nombre'],
					'descripcion'=>$fila['descripcion']
				);
			}
			
			return json_encode($json);
			
		}
		
		
		public function datosProducto($id_producto){
			$json=array();
			$query="SELECT * FROM articulo WHERE id_producto=$id_producto";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_producto'=>$fila['id_producto'],
					'nombre'=>$fila['nombre'],
					'descripcion'=>$fila['descripcion'],
					'cantidad'=>$fila['cantidad'],
					'precio'=>$fila['precio'],
					'imagen'=>$fila['imagen']
				);
			}
			
			return json_encode($json[0]);
		}
		
		

	
		
	} ///end class



	
	$obj=new vender();
	
	if($_POST['f']=='selectc'){
		echo $obj->selectCliente();
	}
	
	if($_POST['f']=='selectp'){
		echo $obj->selectProducto();
	}
	
	if($_POST['f']=='p'){
		echo $obj->datosProducto($_POST['id_producto']);
	}
	


?>