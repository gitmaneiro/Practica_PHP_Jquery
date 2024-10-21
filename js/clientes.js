$(document).ready(function(){
	
	//console.log('javaScript esta funcionando');
	
	traerId();
	listarClientes();
	
	function traerId(){
		
		let usuario={
			usuario:$('#nombreusuario').val(),
			f:'user'
		};
		
		//console.log(usuario);
		$.ajax({
			url:'clases/clientes.php',
			type:'POST',
			data:usuario,
			success:function(respuesta){
				//console.log(respuesta);
				let usuario=JSON.parse(respuesta);
				//console.log(usuario);
				$('#idUsuario').val(usuario.id_usuario);
			}
			
			
		});
		
	}
	
	
	$('#form_clientes').submit(function(e){
		if($('#nombre').val()=='' || $('#apellido').val()=='' || $('#direccion').val()=='' || $('#email').val()=='' || $('#telefono').val()=='' || $('#rfc').val()==''){
			alertify.alert('', 'Debes llenar todos los campos');
			return false;
		}
		
		let datos={
			id_usuario:$('#idUsuario').val(),
			nombre:$('#nombre').val(),
			apellido:$('#apellido').val(),
			direccion:$('#direccion').val(),
			email:$('#email').val(),
			telefono:$('#telefono').val(),
			rfc:$('#rfc').val(),
			f:'a'
		};
		
		//console.log(datos);
		$.ajax({
			url:'clases/clientes.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				console.log('agregado con exito');
				$('#form_clientes').trigger('reset');
				alertify.success('Agregado con exito.');
				listarClientes();
			}
			
		});
		
		
		
		
		e.preventDefault();
	});
	
	
	
	function listarClientes(){
		$.ajax({
			url:'clases/clientes.php',
			type:'POST',
			data:{f:'t'},
			success:function(respuesta){
				//console.log(respuesta);
				let clientes=JSON.parse(respuesta);
				//console.log(clientes);
				let template='';
				
				clientes.forEach(cliente=>{
					template+=`
						<tr tareaId="${cliente.id_cliente}">
							<td>${cliente.nombre}</td>
							<td>${cliente.apellido}</td>
							<td>${cliente.direccion}</td>
							<td>${cliente.email}</td>
							<td>${cliente.telefono}</td>
							<td>
								<button class="btn btn-secondary btn-sm tarea-unica" data-toggle="modal" data-target="#actualizarCliente"><i class="far fa-edit"></i></button>
							</td>
							<td>
								<button class="btn btn-danger btn-sm borrar-tarea"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
					
					`
				});
				
				$('#clientes').html(template);
				
				
			}
			
			
		});
	}
	
	
	
	$(document).on('click', '.borrar-tarea', function(){
		if(confirm('Esta seguro de eliminar este cliente?')){
			
			let element=$(this)[0].parentElement.parentElement;
			let id=$(element).attr('tareaId');
			console.log(id);
		
			$.ajax({
				url:'clases/clientes.php',
				type:'POST',
				data:{id, f:'e'},
				success:function(respuesta){
					console.log('eliminado con exito');
					alertify.error('Eliminado.');
					listarClientes();
				}
			
			
			});	
			
		}
		
	});
	
	
	$(document).on('click', '.tarea-unica', function(){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaId');
		//console.log(id);
		
		$.ajax({
			url:'clases/clientes.php',
			type:'POST',
			data:{id, f:'tu'},
			success:function(respuesta){
				//console.log(respuesta);
				let cliente=JSON.parse(respuesta);
				
				$('#id_clienteu').val(cliente.id_cliente);
				$('#nombreu').val(cliente.nombre);
				$('#apellidou').val(cliente.apellido);
				$('#direccionu').val(cliente.direccion);
				$('#emailu').val(cliente.email);
				$('#telefonou').val(cliente.telefono);
				$('#rfcu').val(cliente.rfc);
				
			}
			
			
		});
		
		
	});
	
	
	
	$('#btnActualizarCliente').click(function(){
		let datos={
			id_cliente:$('#id_clienteu').val(),
			nombre:$('#nombreu').val(),
			apellido:$('#apellidou').val(),
			direccion:$('#direccionu').val(),
			email:$('#emailu').val(),
			telefono:$('#telefonou').val(),
			rfc:$('#rfcu').val(),
			f:'edit'
		};
		
		//console.log(datos);
		$.ajax({
			url:'clases/clientes.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				console.log('Actualizado con exito');
				alertify.success('Actualizado con exito.');
				listarClientes();
			}
			
		});
		
		
	});
	
	
	
	
	
	
	
	
	
	
});