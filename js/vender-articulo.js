$(document).ready(function(){
	
	$('#tablaTempVenta').load('tablaArticuloTemp.php');
	$('#bodyVentasHechas').load('contenido/tablaVentasHecha.php');
	//console.log('jquery esta funcionando');
	selectCliente();
	selectProducto();
	
	function selectCliente(){
		$.ajax({
			url:'clases/vender-articulo.php',
			type:'POST',
			data:{f:'selectc'},
			success:function(respuesta){
				//console.log(respuesta);
				let clientes=JSON.parse(respuesta);
				let template='';
				
				clientes.forEach(cliente=>{
					template+=`
					<option value="${cliente.id_cliente}">${cliente.nombre}</option>
					
					`
				});
				
				$('#selectCliente').append(template);
			}
			
			
		});
		
	}
	
	
	
	
	function selectProducto(){
		$.ajax({
			url:'clases/vender-articulo.php',
			type:'POST',
			data:{f:'selectp'},
			success:function(respuesta){
				//console.log(respuesta);
				let productos=JSON.parse(respuesta);
				let template='';
				
				productos.forEach(producto=>{
					template+=`
					<option value="${producto.id_producto}">${producto.nombre}</option>
					
					`
				});
				
				$('#selectProducto').append(template);
			}
			
			
		});
		
	}
	
	
	$('#selectProducto').change(function(){
		let datos={
			id_producto:$('#selectProducto').val(),
			f:'p'
		};
		
		//console.log(datos);
		$.ajax({
			url:'clases/vender-articulo.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				//console.log(respuesta);
				let producto=JSON.parse(respuesta);
				//console.log(producto);
				$('#descripcionv').val(producto.descripcion);
				$('#cantidadv').val(producto.cantidad);
				$('#preciov').val(producto.precio);
				
				let ruta=String('serverImg/');
				console.log(ruta);
				let template=`<img src="${ruta}${producto.imagen}" class="" width="120"/>`
				
				//console.log(imagen);
				$('#imgProducto'). prepend(template);
			}
			
		});
		
	});
	
		
	
	
	$('#bntAgregaVenta').click(function(){
		
		if($('#selectCliente').val()=='A' || $('#selectProducto').val()=='A' ){
			alertify.alert('', 'Debes seleccionar cliente y producto');
			return false;
		}
		
		let datos={
			id_producto:$('#selectProducto').val(),
			id_cliente:$('#selectCliente').val(),
		};
		
		$.ajax({
			url:'clases/tablaTempPrueba.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				$('#tablaTempVenta').load('tablaArticuloTemp.php');
			}
			
		});
		
		
		
		
		
	});
	
	
	$('#btnVaciarTabla').click(function(){
		console.log('vaciando....');
		$.ajax({
			url:'clases/vaciarVentaTemp.php',
			success:function(respuesta){
				$('#tablaTempVenta').load('tablaArticuloTemp.php');
			}
			
		});
		
	});
	
	
	$(document).on('click', '.producto-unico', function(){
		let element=$(this)[0];
		//console.log(element);
		let index=$(element).attr('pIndex');
		console.log(index);
		
		$.ajax({
			url:'clases/quitarArticuloTemp.php',
			type:'POST',
			data:{index},
			success:function(respuesta){
				console.log('removido con exito');
				$('#tablaTempVenta').load('tablaArticuloTemp.php');
			}
			
		});
		
		
		
	});
	
	
	$(document).on('click', '.crear-venta', function(){
		//console.log('clickeado');
		$.ajax({
			url:'clases/crearVenta.php',
			type:'POST',
			success:function(respuesta){
				if(respuesta > 0){
					console.log('Venta creada con exito');
					alertify.alert('', 'Venta creada con exito.');
					
				}else if(respuesta==0){
					console.log('no hay lista de ventas');
					alertify.alert('' ,'No hay lista de ventas');
				}else{
					console.log('fallo');
				}
				//console.log(respuesta);
			}
			
		});	
		
		
	});
	
	
	
	
	
	
});