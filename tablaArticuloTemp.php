<?php 
	session_start();

?>

	<h4>Hacer venta</h4>
	<h5>Cliente: <span id="nombreClienteVenta"></span></h5>
	<span class="btn btn-warning mb-1"><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i><?php if(isset($_SESSION['tablaTempArticulo']) && count($_SESSION['tablaTempArticulo'])>0){ echo count($_SESSION['tablaTempArticulo']); } ?></span>
	<table class="table table-bordered table-hover">
		<caption><span class="btn btn-success crear-venta" id="crearVenta">Generar venta<span class="fas fa-file-invoice-dollar ml-1"></span></span></caption>
		<thead>
			<tr>
				<td>Nombre</td>
				<td>Descripción</td>
				<td>Cantidad</td>
				<td>Precio</td>
				<td>Quitar</td>
			</tr>
		</thead>
		<tbody>
		
		<?php 
		$total=0;
		$cliente='';
		if(isset($_SESSION['tablaTempArticulo']) && count($_SESSION['tablaTempArticulo'])>0): 
			$i=0;
		foreach($_SESSION['tablaTempArticulo'] as $dato){
			    $producto=explode('||', $dato);
		?>
		
			<tr>
				<td><?php echo $producto[1] ?></td>
				<td><?php echo $producto[2] ?></td>
				<td><?php echo 1;           ?></td>
				<td><?php echo $producto[3] ?></td>
				<td>
					<span class="btn btn-danger btn-sm producto-unico" pIndex="<?php echo $i;?>"><i class="far fa-trash-alt"></i></span>
				</td>
			</tr>
			
		<?php
		$total=$total + $producto[3];
		$i++;
		$cliente=$producto[4];
		}
		 endif;
		 
		?>
		
		</tbody>
		
		<tr>
			<td>Total de venta: <?php echo '$' .$total; ?></td>
		</tr>
	</table>
	
	<script>
		$(document).ready(function(){
			nombre="<?php echo @$cliente ?>";
			$('#nombreClienteVenta').text(nombre);
		});
	</script>