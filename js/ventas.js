$(document).ready(function(){
	
	//console.log('query esta funcionando');
	$('#ventasHechas').hide();
	
	$('#venderArticuloBtn').click(function(){
		$('#ventasHechas').hide();
		$('#venderProducto').show();
	});
	
	$('#ventasHechasBtn').click(function(){
		$('#venderProducto').hide();
		$('#ventasHechas').show();
		
	});
	
	
	
	
	
	
	
	
});