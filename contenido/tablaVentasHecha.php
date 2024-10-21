<?php 

	require_once('../clases/conexion.php');
	require_once('../clases/ventasHechas.php');
	
	$obj=new tablaVentas();
	
	$c=new conectar();
	$db=$c->conexion();
	
	$query="SELECT id_venta, id_cliente, fechaCompra FROM ventas group by id_venta";
	$resultado=$db->prepare($query);
	$resultado->execute();
	
	
	

?>


	<?php while($fila=$resultado->fetch(PDO::FETCH_ASSOC)): ?>
	<tr>
		<td><?php echo $fila['id_venta'] ?></td>
		<td><?php echo $fila['fechaCompra'] ?></td>
		<td><?php echo $obj->nombreCliente($fila['id_cliente']); ?></td>
		<td><?php echo '$'. $obj->obtenerTotal($fila['id_venta']); ?></td>
		<td><a href="#" class="btn btn-danger btn-sm">Ticket<i class="fas fa-clipboard-list ml-2"></i></a></td>
		<td><a href="clases/reportePdfVenta.php?idventa=<?php echo $fila['id_venta']; ?>" class="btn btn-danger btn-sm">Reporte<i class="fas fa-file-alt ml-2"></i></a></td>
	</tr>
	<?php endwhile ?>