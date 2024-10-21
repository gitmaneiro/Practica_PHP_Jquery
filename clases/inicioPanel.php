<?php 

	require_once('conexion.php');
	
	class paneles extends conectar{
		
		private $db;
		
		public function __construct(){			
			$this->db=conectar::conexion();
		}
		
		public function numeroCategoria(){
			$query="SELECT nombreCategoria FROM categoria";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			$numeroCategoria=$resultado->rowCount();
			
			
			return json_encode($numeroCategoria);
		}
		
		public function numeroArticulo(){
			$query="SELECT nombre FROM articulo";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			$numeroArticulo=$resultado->rowCount();
			
			return json_encode($numeroArticulo);
			
		}
		
		public function numeroCliente(){
			$query="SELECT nombre FROM clientes";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			$numeroCliente=$resultado->rowCount();
			
			return json_encode($numeroCliente);
		}
		
		
		public function numeroVentas(){
			$query="SELECT id_venta FROM ventas group by id_venta";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			$numeroVenta=$resultado->rowCount();
			
			return json_encode($numeroVenta);
		}
		
		public function datosGrafica(){
			$json=array();
			
			$query="SELECT fechaCompra, sum(precio) FROM ventas group by fechaCompra";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					$fila['fechaCompra'],
					$fila['sum(precio)']
				);
				
			}
			
			
			
			return json_encode($json, JSON_NUMERIC_CHECK);
		}
		
		
		public function graficaProductos(){
			$json=array();
			
			$query="SELECT nombre, sum(cantidad) FROM articulo group by nombre";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					$fila['nombre'],
					$fila['sum(cantidad)']
				);
			}
			
			return json_encode($json, JSON_NUMERIC_CHECK);
			
		}
		
		
		
	}  ////end class
	
	
	
	
	$obj=new paneles();
	
	if($_POST['f']=='nc'){
		echo $obj->numeroCategoria();
	}
	
	if($_POST['f']=='na'){
		echo $obj->numeroArticulo();
	}
	
	if($_POST['f']=='ncl'){
		echo $obj->numeroCliente();
	}
	
	if($_POST['f']=='nv'){
		echo $obj->numeroVentas();
	}
	
	if($_POST['f']=='dg'){
		echo $obj->datosGrafica();
	}
	
	if($_POST['f']=='gp'){
		echo $obj->graficaProductos();
	}
	
	
	

?>