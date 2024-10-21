$(document).ready(function(){
	
	traerUsuarios();
	
	$('#form_usuarios').submit(function(e){
		
		if($('#nombre').val()=='' || $('#apellido').val()=='' || $('#usuario').val()=='' || $('#password').val()=='' ){
			alertify.alert('', 'Debes llenar todos los campos');
			return false;
		}
		
		let datos={
			nombre:$('#nombre').val(),
			apellido:$('#apellido').val(),
			email:$('#usuario').val(),
			password:$('#password').val(),
			f:'a'
		};
		
		//console.log(datos);
		
		$.ajax({
			url:'clases/classusuarios.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				if(respuesta!=0){
					$('#form_usuarios').trigger('reset');
					alertify.success('Agregado con exito.');
					traerUsuarios();
				}
				
			}
				
			
		});
		
		e.preventDefault();
	});
	
	
	
	
	function traerUsuarios(){
		$.ajax({
			url:'clases/classusuarios.php',
			type:'POST',
			data:{f:'t'},
			success:function(respuesta){
				//console.log(respuesta);
				let usuarios=JSON.parse(respuesta);
				//console.log(usuarios);
				let template='';
				
				usuarios.forEach(usuario=>{
					template+=`
						<tr tareaId="${usuario.id}">
							<td>${usuario.nombre}</td>
							<td>${usuario.apellido}</td>
							<td>${usuario.email}</td>
							<td>
								<button class="btn btn-secondary btn-sm tarea-unica" data-toggle="modal" data-target="#actualizarUsuario"><i class="far fa-edit"></i></button>
							</td>
							<td>
								<button class="btn btn-danger btn-sm borrar-tarea"><i class="far fa-trash-alt"></i></butto>
							</td>
						</tr>
					`
				});
				
				$('#usuarios').html(template);
			}
			
		});
	}
	
	
	
	$(document).on('click', '.borrar-tarea', function(){

		if(confirm('Esta seguro de eliminar este usuario')){
			let element=$(this)[0].parentElement.parentElement;
			let id=$(element).attr('tareaId');
			//console.log(id);
			$.ajax({
				url:'clases/classusuarios.php',
				type:'POST',
				data:{id, f:'e'},
				success:function(respuesta){
					console.log('eliminado con exito');
					alertify.error('Eliminado.');
					traerUsuarios();
				}
			
			});
				
		}	
		
	});
	
	
	$(document).on('click', '.tarea-unica', function(){
		let element=$(this)[0].parentElement.parentElement;
		let id=$(element).attr('tareaId');
			//console.log(id);
			$.ajax({
				url:'clases/classusuarios.php',
				type:'POST',
				data:{id, f:'tu'},
				success:function(respuesta){
					//console.log(respuesta);
					let usuario=JSON.parse(respuesta);
					$('#idUsuariou').val(usuario.id);
					$('#nombreu').val(usuario.nombre);
					$('#apellidou').val(usuario.apellido);
					$('#usuariou').val(usuario.email);
					$('#passwordu').val(usuario.password);
				}
				
			});
		
	});
	
	
	
	$('#btnActualizarUsuario').click(function(){
			let datos={
				id:$('#idUsuariou').val(),
				nombre:$('#nombreu').val(),
				apellido:$('#apellidou').val(),
				email:$('#usuariou').val(),
				password:$('#passwordu').val(),
				f:'edit'
			};
		
		 console.log(datos);
		 $.ajax({
			 url:'clases/classusuarios.php',
			 type:'POST',
			 data:datos,
			 success:function(respuesta){
				 //console.log('editado con exito');
				 alertify.success('Actualizado con exito.');
				 traerUsuarios();
			 }
			 
			 
		 });
		 
		 
		 
		
	});
	
	
	
});