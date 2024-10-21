<?php 
	
	require_once('conexion.php');
	
	class categorias extends conectar{
		
		private $db;
		
		public function __construct(){
			
			$this->db=conectar::conexion();
		}
		
		public function agregarCategoria($idusuario, $nombreCategoria){
			$fecha= date('y-m-d');
			$query="INSERT INTO categoria (id_usuario, nombreCategoria, fechaCaptura) VALUES ('$idusuario', '$nombreCategoria', '$fecha')";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			return $resultado;
		}
		
		public function traerId($usuario){
			$json=array();
			$query="SELECT * FROM usuarios WHERE email=:usuario";
			$resultado=$this->db->prepare($query);
			$email=htmlentities($_POST['usuario']);
			$resultado->bindValue(":usuario", $email);
			$resultado->execute();
			//return json_encode($resultado->fetch(PDO::FETCH_ASSOC));
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id'=>$fila['id_usuario'],
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido']
				);
			}
			
			return json_encode($json[0]);
		}
		
		public function listasCategorias(){
			$json=array();
			$query="SELECT * FROM categoria";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_categoria'=>$fila['id_categoria'],
					'categoria'=>$fila['nombreCategoria']
				);
			}
			
			return json_encode($json);
			
		}
		
		
		public function eliminarCategoria($id){
			$query="DELETE FROM categoria WHERE id_categoria=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		public function tareaUnica($id){
			$json=array();
			$query="SELECT * FROM categoria WHERE id_categoria=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'categoria'=>$fila['nombreCategoria'],
					'id_categoria'=>$fila['id_categoria']
				);
			}
			
			return json_encode($json[0]);
		}
		
		
		
		public function editarCategoria($idCategoria, $nombreCategoria){
			$query="UPDATE categoria SET nombreCategoria=:nombreCategoria WHERE id_categoria=:idCategoria";
			$resultado=$this->db->prepare($query);
			$resultado->bindValue(':idCategoria', $idCategoria, PDO::PARAM_INT);
			$resultado->bindValue(':nombreCategoria', $nombreCategoria, PDO::PARAM_STR);
			$resultado->execute();
			return $resultado;
		}
		
		
		
		
		
	}  //end classs
	
	
	
	$obj=new categorias();
	
	if($_POST['f']=='a'){
		echo $obj->agregarCategoria($_POST['idusuario'], $_POST['categoria']);
	}
	
	if($_POST['f']=='user'){
		echo $obj->traerId($_POST['usuario']);
	}
	
	if($_POST['f']=='traer'){
		echo $obj->listasCategorias();
	}
	
	if($_POST['f']=='e'){
		echo $obj->eliminarCategoria($_POST['id']);
	}
	
	if($_POST['f']=='tu'){
		echo $obj->tareaUnica($_POST['id']);
	}
	
	if($_POST['f']=='edit'){
		echo $obj->editarCategoria($_POST['idCategoria'], $_POST['categoria']);
	}






?>