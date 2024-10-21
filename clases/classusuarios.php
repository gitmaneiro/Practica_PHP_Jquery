<?php 

	require_once('conexion.php');
	
	class usuario extends conectar{
		
		private $db;
		
		public function __construct(){
			$this->db=conectar::conexion();
		}
		
		
		public function agragarUsuario($nombre, $apellido, $email, $password){
			$fecha=date('y-m-d');
			$query="INSERT INTO usuarios (nombre, apellido, email, password, fechaCaptura) VALUES ('$nombre', '$apellido', '$email', '$password', '$fecha')";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		public function traerUsuarios(){
			$json=array();
			$query="SELECT * FROM usuarios";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido'],
					'email'=>$fila['email'],
					'id'=>$fila['id_usuario']
				);
				
			}
			
			return json_encode($json);
			
			
		}
		
		
		
		
		public function eliminarUsuario($id){
			$query="DELETE FROM usuarios WHERE id_usuario=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		public function tareaUnica($id){
			$json=array();
			$query="SELECT * FROM usuarios WHERE id_usuario=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id'=>$fila['id_usuario'],
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido'],
					'email'=>$fila['email'],
					'password'=>$fila['password']
				);
			}
			
			return json_encode($json[0]);
			
		}
		
		
		public function editarUsuario($id, $nombre, $apellido, $email, $password){
			$query="UPDATE usuarios SET nombre=:nombre, apellido=:apellido, email=:email, password=:password WHERE id_usuario=:id";
			$resultado=$this->db->prepare($query);
			$resultado->bindValue(':id', $id);
			$resultado->bindValue(':nombre', $nombre);
			$resultado->bindValue(':apellido', $apellido);
			$resultado->bindValue(':email', $email);
			$resultado->bindValue(':password', $password);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		
	} ///end class



	
	$obj=new usuario();
	
	if($_POST['f']=='a'){
		echo $obj->agragarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['password']);
	}
	
	if($_POST['f']=='t'){
		echo $obj->traerUsuarios();
	}
	
	if($_POST['f']=='e'){
		echo $obj->eliminarUsuario($_POST['id']);
	}
	
	if($_POST['f']=='tu'){
		echo $obj->tareaUnica($_POST['id']);
	}
	
	if($_POST['f']=='edit'){
		echo $obj->editarUsuario($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['password']);
	}
	
	
	
	
	
	
	
	
	

?>