$(document).ready(function(){
	
	
	llenarSelect();
	traerId();
	traerArticulos();
	function llenarSelect(){
		
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:{f:'select'},
			success:function(respuesta){
				//console.log(respuesta);
				let categorias=JSON.parse(respuesta);
				//console.log(categorias);
				let template="";
				
				categorias.forEach(categoria=>{
					template+=`
						<option value="${categoria.id}">${categoria.categoria}</option>
					`
					
				});
				
				$('#selectCategoria').append(template);
				$('#selectCategoriau').append(template);
			}
			
		});
		
	}
	
	
	function traerId(){
		let usuario={
			usuario:$('#nombreusuario').val(),
			f:'user'
		};
		
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:usuario,
			success:function(respuesta){
				let usuario=JSON.parse(respuesta);
				//console.log(usuario);
				$('#idUsuario').val(usuario.id_usuario);
				
			}
			
		});
		
		
	}
	
	
	$('#form_articulos').submit(function(e){
		if($('#selectCategoria').val()=='A' || $('#nombre').val()=='' || $('#descripcion').val()=='' || $('#cantidad').val()=='' || $('#precio').val()==''){
			alertify.alert('', 'Debes llenar los campos que son obligatorios.');
			return false;
		}
		
		var formData=new FormData(document.getElementById('form_articulos'));
		//var files=$('#imagen')[0].files[0];
		formData.append('f', 'a');
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:formData,
			contentType: false,
            processData: false,
			success:function(respuesta){
				//console.log(respuesta);
				$('#form_articulos').trigger('reset');
				alertify.success('Agregado con exito.');
				traerArticulos();
			}
			
			
		});
		
		
		e.preventDefault();
	});
	
	
	function traerArticulos(){
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:{f:'t'},
			success:function(respuesta){
				//console.log(respuesta);
				let articulos=JSON.parse(respuesta);
				//console.log(articulos);
				let ruta=String('serverImg/');
				//console.log(ruta);
				let template='';
				
				articulos.forEach(articulo=>{
					template+=`
						<tr tareaId="${articulo.id_articulo}">
							<td>${articulo.nombre}</td>
							<td>${articulo.descripcion}</td>
							<td>${articulo.cantidad}</td>
							<td>${articulo.precio}</td>
							<td><img src="${ruta}${articulo.imagen}" width="40" /></td>
							<td>${articulo.categoria}</td>
							<td>
								<button class="btn btn-secondary btn-sm tarea-unica" data-toggle="modal" data-target="#actualizarArticulo"><i class="far fa-edit"></i></button>
							</td>
							<td>
								<button class="btn btn-danger btn-sm borrar-tarea"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
					
					`
				});
				
				$('#articulos').html(template);
				
			}
		});
	}
	
	
	$(document).on('click', '.borrar-tarea', function(){
		if(confirm('Esta seguro de eliminar este articulo?')){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaid');
		//console.log(id);
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:{id, f:'e'},
			success:function(respuesta){
				console.log('Eliminado con exito..');
				alertify.error('Eliminado');
				traerArticulos();
			}
			
			
			
		});
			
		}
		
		
		
	});
	
	
	$(document).on('click', '.tarea-unica', function(){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaId');
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:{id, f:'tu'},
			success:function(respuesta){
				//console.log(respuesta);
				let articulo=JSON.parse(respuesta);
				//console.log(articulo);
				$('#selectCategoriau').val(articulo.id_categoria);
				$('#idArticulou').val(articulo.id_articulo);
				$('#nombreu').val(articulo.nombre);
				$('#descripcionu').val(articulo.descripcion);
				$('#cantidadu').val(articulo.cantidad);
				$('#preciou').val(articulo.precio);
				
				
			}
			
		});
	});
	
	
	$('#btnActualizarArticulo').click(function(){
		
		let datos={
			categoria:$('#selectCategoriau').val(),
			id_producto:$('#idArticulou').val(),
			nombre:$('#nombreu').val(),
			descripcion:$('#descripcionu').val(),
			cantidad:$('#cantidadu').val(),
			precio:$('#preciou').val(),
			f:'edit'
		};
		
		//console.log(datos);
		$.ajax({
			url:'clases/articulos.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				if(respuesta!=0){
					console.log('actualizado con exito');
					alertify.success('Actualizado con exito');
					traerArticulos();
				}
				
			}
			
		});
		
	});
	
	
	
	
	
	
});