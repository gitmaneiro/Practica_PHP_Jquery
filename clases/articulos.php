<?php 

	require_once('conexion.php');
	
	class articulos extends conectar{
		
		private $db;
		
		public function __construct(){
			
			$this->db=conectar::conexion();
			
		}
		
		public function llenarSelect(){
			$json=array();
			$query="SELECT * FROM categoria";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id'=>$fila['id_categoria'],
					'categoria'=>$fila['nombreCategoria'],
					'id_usuario'=>$fila['id_usuario']
				);
			}
			
			return json_encode($json);
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
		
		
		public function agregaArticulo($selectCategoria, $idUsuario, $nombre, $descripcion, $cantidad, $precio, $nombre_imagen){
			$fecha= date('y-m-d');
			$query="INSERT INTO articulo (id_categoria, id_usuario, imagen, nombre, descripcion, cantidad, precio, fechaCaptura) VALUES ('$selectCategoria', '$idUsuario', '$nombre_imagen', '$nombre', '$descripcion', '$cantidad', '$precio', '$fecha')";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		public function traerArticulis(){
			$json=array();
			//$query="SELECT * FROM articulo";
			$sql="SELECT a.id_producto, a.nombre, a.descripcion, a.cantidad, a.precio, a.imagen, c.nombreCategoria FROM articulo as a, categoria as c WHERE a.id_categoria=c.id_categoria";
			$resultado=$this->db->prepare($sql);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_articulo'=>$fila['id_producto'],
					'nombre'=>$fila['nombre'],
					'descripcion'=>$fila['descripcion'],
					'cantidad'=>$fila['cantidad'],
					'precio'=>$fila['precio'],
					'imagen'=>$fila['imagen'],
					'categoria'=>$fila['nombreCategoria']
				);
				
				
			}
			
			return json_encode($json);
			
			
		}
		
		
		
		public function eliminarArticulo($id){
			$query="DELETE FROM articulo WHERE id_producto=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			
			return $resultado;
		}
		
		public function tareaUnica($id){
			$json=array();
			$query="SELECT * FROM articulo WHERE id_producto=$id";
			$resultado=$this->db->prepare($query);
			$resultado->execute();
			while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
				$json[]=array(
					'id_articulo'=>$fila['id_producto'],
					'id_categoria'=>$fila['id_categoria'],
					'nombre'=>$fila['nombre'],
					'descripcion'=>$fila['descripcion'],
					'cantidad'=>$fila['cantidad'],
					'precio'=>$fila['precio'],
					'imagen'=>$fila['imagen']
				);
			}
			
			return json_encode($json[0]);
			
		}
		
		
		public function editarArticulo($categoria, $id_producto, $nombre, $descripcion, $cantidad, $precio){
			$query="UPDATE articulo SET id_categoria=:categoria, nombre=:nombre, descripcion=:descripcion, cantidad=:cantidad, precio=:precio WHERE id_producto=:id_producto";
			$resultado=$this->db->prepare($query);
			$resultado->bindValue(':categoria', $categoria, PDO::PARAM_INT);
			$resultado->bindValue(':nombre', $nombre, PDO::PARAM_STR);
			$resultado->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
			$resultado->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
			$resultado->bindValue(':precio', $precio, PDO::PARAM_INT);
			$resultado->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
			$resultado->execute();
			
			return $resultado;
		}
		
		
		
		
		
		
		
	} ///end class
	
	
	
	$obj=new articulos();

	if($_POST['f']=='select'){
		echo $obj->llenarSelect();
	}
	
	if($_POST['f']=='user'){
		echo $obj->traerId($_POST['usuario']);
	}

	if($_POST['f']=='a'){
		$nombre_imagen=$_FILES['imagen']['name'];
		$tipo_imagen=$_FILES['imagen']['type'];
		$tamano_imagen=$_FILES['imagen']['size'];
		
		if($tamano_imagen<=1000000 || $tipo_imagen=='image/jpg' || $tipo_imagen=='image/jpeg' || $tipo_imagen=='image/png'){
			$carpeta_destino='../serverImg/';
			move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);
		
		}else{ echo "error al subir la imagen"; }
		
		echo $obj->agregaArticulo($_POST['selectCategoria'], $_POST['idUsuario'], $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio'], $_FILES['imagen']['name'] );
	}
	
	if($_POST['f']=='t'){
		echo $obj->traerArticulis();
	}
	
	
	if($_POST['f']=='e'){
		echo $obj->eliminarArticulo($_POST['id']);
	}

	if($_POST['f']=='tu'){
		echo $obj->tareaUnica($_POST['id']);
	}
	
	if($_POST['f']=='edit'){
		echo $obj->editarArticulo($_POST['categoria'], $_POST['id_producto'], $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio']);
	}
	
	
	
	

?>