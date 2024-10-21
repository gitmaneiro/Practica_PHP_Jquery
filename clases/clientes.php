<?php 
	require_once('conexion.php');
	
	class clientes extends conectar{
		
		private $db;

		public function __construct(){
			$this->db=conectar::conexion();
		}
		
		
		public function traerId($usuario){
			$json=array();
			$query="SELECT * FROM usuarios WHERE email=:usuario";
			$resultado=$this->db->prepare($query);
			$email=htmlentities($usuario);
			$resultado->bindValue(':usuario', $email, PDO::PARAM_STR);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_usuario'=>$fila['id_usuario'],
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido']
				);
			}
			
			return json_encode($json[0]);
			
			
		}
		
		
		
		public function agregarCliente($id_isuario, $nombre, $apellido, $direccion, $email, $telefono, $rfc){
			$query="INSERT INTO clientes (id_usuario, nombre, apellido, direccion, email, telefono, rfc) VALUES ('$id_isuario', '$nombre', '$apellido', '$direccion', '$email', '$telefono', '$rfc')";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
			
		}
		
		public function listarClientes(){
			$json=array();
			$query="SELECT * FROM clientes";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
				'id_cliente'=>$fila['id_cliente'],
				'nombre'=>$fila['nombre'],
				'apellido'=>$fila['apellido'],
				'direccion'=>$fila['direccion'],
				'email'=>$fila['email'],
				'telefono'=>$fila['telefono'],
				'rfc'=>$fila['rfc']
				);
			}
			
			
			return json_encode($json);
			
		}
		
		
		public function eliminarCliente($id){
			$query="DELETE FROM clientes WHERE id_cliente=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		
		public function tareaUnica($id){
			$json=array();
			$query="SELECT * FROM clientes WHERE id_cliente=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_cliente'=>$fila['id_cliente'],
					'nombre'=>$fila['nombre'],
					'apellido'=>$fila['apellido'],
					'direccion'=>$fila['direccion'],
					'email'=>$fila['email'],
					'telefono'=>$fila['telefono'],
					'rfc'=>$fila['rfc']
				);
			}
			
			
			return json_encode($json[0]);
			
			
		}
		
		public function editarCliente($id_cliente, $nombre, $apellido, $direccion, $email, $telefono, $rfc){
			$query="UPDATE clientes SET nombre=:nombre, apellido=:apellido, direccion=:direccion, email=:email, telefono=:telefono, rfc=:rfc WHERE id_cliente=:id_cliente";
			$resultado=$this->db->prepare($query);
			$resultado->bindValue(':nombre', $nombre);
			$resultado->bindValue(':apellido', $apellido);
			$resultado->bindValue(':direccion', $direccion);
			$resultado->bindValue(':email', $email);
			$resultado->bindValue(':telefono', $telefono);
			$resultado->bindValue(':rfc', $rfc);
			$resultado->bindValue(':id_cliente', $id_cliente);
			$resultado->execute();
			
			return $resultado;
			
			
			
		}
		
		
		
		
		
	} ///end class




	$obj=new clientes();
	
	if($_POST['f']=='user'){
		echo $obj->traerId($_POST['usuario']);
	}
	
	if($_POST['f']=='a'){
		echo $obj->agregarCliente($_POST['id_usuario'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['email'], $_POST['telefono'], $_POST['rfc']);
	}
	
	if($_POST['f']=='t'){
		echo $obj->listarClientes();
	}
	
	if($_POST['f']=='e'){
		echo $obj->eliminarCliente($_POST['id']);
	}
	
	if($_POST['f']=='tu'){
		echo $obj->tareaUnica($_POST['id']);
	}
	
	if($_POST['f']=='edit'){
		echo $obj->editarCliente($_POST['id_cliente'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['email'], $_POST['telefono'], $_POST['rfc']);
	}












?>