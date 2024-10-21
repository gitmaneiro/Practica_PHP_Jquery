<?php 

	require_once('conexion.php');
	
	class usuarios extends conectar{
			private $db;
			
			public function __construct(){
				
				$this->db=conectar::conexion();
			}
			
		public function registrarUsuario($nombre, $apellido, $email, $password){
			//$cn=new conectar();
			//$conexion=$cn->conexion();
			$fecha=date('y-m-d');
			
			$query="INSERT INTO usuarios (nombre, apellido, email, password, fechaCaptura) VALUES ('$nombre', '$apellido', '$email', '$password', '$fecha')";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			return $resultado;
		}
		
		public function comprobarLogin($email, $password){
			$query="SELECT * FROM usuarios WHERE email=:usuario AND password=:password";
			$resultado=$this->db->prepare($query);
			$email=htmlentities($_POST['email']);
			$password=htmlentities($_POST['password']);
			$resultado->bindValue(":usuario", $email);
			$resultado->bindValue(":password", $password);
			$resultado->execute();
			$numero_registro=$resultado->rowCount();
			if($numero_registro!=0){
				session_start();
				$_SESSION['usuario']=$_POST['email'];
				return $numero_registro;
			}
		}
		
		
		
		
		
		
		
	} //fianl de la classe

	//if($conexpdo->conexion()){
	//	echo 'Conectado a la base de datos';
	//}
	
	
	
	$obj=new usuarios();
	
	if($_POST['f']=='a'){
		echo $obj->registrarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['password']);
	}
	
	if($_POST['f']=='l'){
		echo $obj->comprobarLogin($_POST['email'], $_POST['password']);
	}
?>