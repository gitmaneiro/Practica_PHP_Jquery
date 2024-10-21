$(document).ready(function(){
	//console.log('javaScript esta funcionando');
	traerId();
	traerCategorias();

	$('#form_categorias').submit(function(e){
		
		//let f=editar===false?'a':'ed';
		if($('#categoria').val()==''){
			alertify.alert('', 'Debes llenar el campo categoria.');
			return false;
		}
		
		let categoria={
			categoria:$('#categoria').val(),
			idusuario:$('#idUsuario').val(),
			f:'a'
			};
			
		console.log(categoria);
		$.ajax({
			url:'clases/categorias.php',
			type:'POST',
			data:categoria,
			success:function(respuesta){
				//console.log('agragado con exito');
				if(respuesta!=0){
					//console.log('agragado');
					alertify.success('Agregado con exito');
					$('#form_categorias').trigger('reset');
					traerCategorias();
				}
			}
		});
		
		e.preventDefault();
	});
	
	function traerId(){
		
		let usuario={
			usuario:$('#nombreusuario').val(),
			f:'user'
		};
		
		
		$.ajax({
			url:'clases/categorias.php',
			type:'POST',
			data:usuario,
			success:function(res){
				let usuario=JSON.parse(res);
				console.log(usuario);
				$('#idUsuario').val(usuario.id);
				
			}
			
		});
		
	}
	
	
	function traerCategorias(){
	$.ajax({
			url:'clases/categorias.php',
			type:'POST',
			data:{f:'traer'},
			success:function(r){
				var categorias= JSON.parse(r);
				console.log(categorias);
				
				let template='';
				
				categorias.forEach(categoria=>{
					template+=`
						<tr tareaId="${categoria.id_categoria}">
							<td>${categoria.categoria}</td>
							<td>
								<button class="btn btn-secondary btn-sm tarea-unica" data-toggle="modal" data-target="#actualizarmodal"><i class="far fa-edit"></i></button>
							</td>
							<td>
								<button class="btn btn-danger btn-sm borrar-tarea"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
					`	
				});
				
				$('#categorias').html(template);
				
			}			
		});
	}
	
	$(document).on('click', '.borrar-tarea', function(){
		if(confirm('Esta seguro de eliminar esta categoria?')){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaId');
		//alert(id);
		$.ajax({
			url:'clases/categorias.php',
			type:'POST',
			data:{id, f:'e'},
			success:function(respuesta){
				//console.log('eliminado con exito');
				alertify.error('Eliminado');
				traerCategorias();
			}
		});
			
		}
		
	});
	
	
	$(document).on('click', '.tarea-unica', function(){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaId');
		//console.log(id);
		$.ajax({
			url:'clases/categorias.php',
			type:'POST',
			data:{id, f:'tu'},
			success:function(respuesta){
				let categoria=JSON.parse(respuesta);
				//console.log(categoria);
				$('#actualizacategoria').val(categoria.categoria);
				$('#midCategoria').val(categoria.id_categoria);
		
			}
		});
		
		
		
	});
	
	
	
	$('#actualizar').click(function(){
		
			let datos={
				idCategoria:$('#midCategoria').val(),
				categoria:$('#actualizacategoria').val(),
				f:'edit'
			};
			
			console.log(datos);
			
			$.ajax({
				url:'clases/categorias.php',
				type:'POST',
				data:datos,
				success:function(respuesta){
					if(respuesta!=0){
						console.log('actualizado');
						alertify.success('Actualizado con exito');
						traerCategorias();
					}
				}
				
			});
		
	});
	
	
	
	
	
	
	
});