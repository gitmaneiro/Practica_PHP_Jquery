$(document).ready(function(){
	
	console.log('javascript de inicio esta funcionando');
	
	
	numeroCategoria();
	numeroArticulos();
	numeroClientes();
	numeroVentas();
	datosGrafica();
	graficaProductos();
	
	function numeroCategoria(){
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'nc'},
			success:function(respuesta){
				//console.log(respuesta);
				var numeroCategoria=JSON.parse(respuesta);
				//console.log(numeroCategoria);
				$('#ncategoria').text(numeroCategoria);
			}
			
		});
	}
	
	
	function numeroArticulos(){
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'na'},
			success:function(respuesta){
				//console.log(respuesta);
				var numeroArticulo=JSON.parse(respuesta);
				$('#narticulo').text(numeroArticulo);
			}
		});
		
	}
	
	function numeroClientes(){
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'ncl'},
			success:function(respuesta){
				var numeroCliente=JSON.parse(respuesta);
				$('#ncliente').text(numeroCliente);
			}
			
		});
	}
	
	
	function numeroVentas(){
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'nv'},
			success:function(respuesta){
				//console.log(respuesta);
				var numeroVenta=JSON.parse(respuesta);
				$('#nventas').text(numeroVenta);
			}
		});
		
	}
	
	
	
	
	//$('#grafica').highcharts({
	//	title:{
	//		text:'Grafico de Ventas'
	//	},
	//	
	//	xAxis:{
	//		categories:['Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
	//	},
	//	
	//	yAxis:{
	//		title:'porcentaje %', plotlines:[{value:0, width:1, color:'#808080'}]
	//	},
	//	
	//	tooltip:{
	//		valueSuffix:'$'
	//	},
	//	
	//	legend: {
	//		align: 'right',
	//		verticalAlign: 'top',
	//		layout: 'vertical',
	//		x: 0,
	//		y: 120
	//	},
	//	
	//	series:[{name:'Ventas', data:[20, 46, 36, 14, 71]}]
	//	
	//});
	

	
	function datosGrafica(){		
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'dg'},
			success:function(respuesta){
				//console.log(respuesta);
				var datos=JSON.parse(respuesta);
				//console.log(datos);
				//console.log(datos);
				
				
		$('#grafica').highcharts({
			title:{
				text:'Grafico de Ventas'
			},
		
			xAxis:{
				type:'category'
			},
		
			yAxis:{
				title:{text:'Total recaudado'} 	
			},
		
			tooltip:{
				valueSuffix:'$'
			},
		
			legend: {
				align: 'right',
				verticalAlign: 'top',
				layout: 'vertical',
				x: 0,
				y: 120
			},
		
			series:[{
				name:'ventas',
				type:'spline',
				data:datos
			}]
		
		});
				
				
					
			}
		});
	}
	
	
	function graficaProductos(){
		$.ajax({
			url:'clases/inicioPanel.php',
			type:'POST',
			data:{f:'gp'},
			success:function(respuesta){
				console.log(respuesta);
				var datos=JSON.parse(respuesta);
				
				$('#graficaProductos').highcharts({
					title:{
						text:'Stock de Artículos'
					},
					
					xAxis:{
						type:'category'
					},
					
					yAxis:{title:'Stock'},
					
					tooltip:{
						valueSuffix:'Nº'
					},
					
					legend:{
						align:'right',
						verticalAlign:'top',
						layoud:'vertical',
						x:0,
						y:120
					},
					
					series:[{
						name:'Articulos',
						type:'column',
						colorByPoint:true,
						data:datos
					}]
					
				});
				
			}
			
		});
		
		
	}
	
	
	
	
	
	
});