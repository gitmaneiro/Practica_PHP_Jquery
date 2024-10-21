<?php 

	class conectar{
		
		var $conexpdo;
		
		function conexion(){
			
			try{
				$this->conexpdo= new PDO('mysql:host=localhost;dbname=ventas', 'root', '' );
				
				$this->conexpdo->exec("SET CHARACTER SET UTF8");
				
				
				
			}catch(PDOException $e){
				
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();

			
			}
		
			return $this->conexpdo;
		
		}
		
	}	
	
	//$conexpdo= new conectar();
	
?>