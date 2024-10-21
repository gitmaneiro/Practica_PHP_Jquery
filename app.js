$(document).ready(function(){
	
	$('#form_registro').submit(function(e){
		
		if($('#nombre').val()=="" || $('#apellido').val()=="" || $('#usuario').val()=="" || $('#clave').val()==""){
			alert('Debes llenar todos los campos');
			return false;
		}
		
		let datos={
			nombre:$('#nombre').val(),
			apellido:$('#apellido').val(),
			email:$('#usuario').val(),
			password:$('#clave').val(),
			f:'a'
			
		};
		
		console.log(datos);
		$.ajax({
			url:'clases/usuarios.php',
			type:'POST',
			data:datos,
			success:function(respuesta){
				alert('agregado con exito');
				$('#form_registro').trigger('reset');
				
				
			}
			
			
		});
		
	
		e.preventDefault();
	});
	
	
	
	$('#form_login').submit(function(e){
		
		if($('#usuario').val()=="" || $('#clave').val()==""){
			alert('Daber llenar toso los campos');
			return false;
		}

		
		let loginData={
			email:$('#usuario').val(),
			password:$('#clave').val(),
			f:'l'
		};
			
		
		$.ajax({
			url:'clases/usuarios.php',
			type:'POST',
			data:loginData,
			success:function(respuesta){
				if(respuesta!=0){
					console.log(respuesta);
					window.location='inicio.php';
				}else{
					alert('No puedes entrar');
					//window.location='index.html';
				}
			}
		});
		
			
		
		e.preventDefault();
	});
	
	
});