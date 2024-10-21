<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('location:registro.html');	
	}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="librerias/css/all.min.css">
	<link rel="stylesheet" href="css/inicio.css">
	
  </head>
  <body>
	<div class="container-fluid navbar-dark bg-dark">
		<nav class="navbar navbar-expand-md container">
		 <a class="navbar-brand" href="#">
			<img src="" width="" height="" class="d-inline-block align-top" alt="" loading="lazy">
			Almacen y Ventas
		 </a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		 <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="nav navbar-nav ml-auto">
			<li class="nav-item active"><a class="nav-link" href="#"><span class="fas fa-house-user mr-1"></span>Inicio</a></li>
			<li class="dropdown ml-2">
				<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><span class="fas fa-boxes mr-1"></span>Administrar Artículos</a>
			<ul class="dropdown-menu nav-item">
				<li><a class="dropdown-item" href="categorias.php">Categoria</a></li>
				<li><a class="dropdown-item" href="articulos.php">Articulos</a></li>
			</ul>
			</li>
			<li class="nav-item ml-2"><a class="nav-link" href="usuarios.php"><span class="fas fa-users mr-1"></span>Administrar Usuarios</a></li>
			<li class="nav-item ml-2"><a class="nav-link" href="clientes.php"><span class="fas fa-user-plus mr-1"></span>Clientes</a></li>
			<li class="nav-item ml-2"><a class="nav-link" href="vender-articulos.php"><span class="fas fa-file-invoice-dollar mr-1"></span>Vender Artículo</a></li>
			<li class="dropdown ml-2">
				<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><span class="fas fa-user-lock mr-1"></span>Sesión</a>
				<ul class="dropdown-menu nav-item">
					<li><a class="dropdown-item" href="clases/cerrar.php"><span class="fas fa-power-off mr-1"></span>Cerrar sesión</a></li>
				</ul>
			</li>
			</ul>
		
		</div>
	</nav>
	</div>
	
	<div class="container-fluid">
		<div class="container py-4">
			<div class="row">
				<div class="col-md-3">
					<div class="card bg-categoria mb-3">
						<a href="#" class="card-body btn p-3">
							<span class="fas fa-pallet fa-3x c-span d-flex justify-content-start mb-2"></span>
							<p class="mb-0 text-left">Categorias</p>
						</a>
						<div class="card-footer p-0">
							<p class="p-0 mb-0 text-center h6" id="ncategoria">0</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-articulo mb-3">
						<a href="#" class="card-body btn p-3">
							<span class="fas fa-box-open fa-3x c-span d-flex justify-content-start mb-2"></span>
							<p class="mb-0 text-left">Articulos</p>
						</a>
						<div class="card-footer p-0">
							<p class="p-0 mb-0 text-center h6" id="narticulo">0</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-cliente mb-3">
						<a href="#" class="card-body btn p-3">
							<span class="fas fa-user-plus fa-3x c-span d-flex justify-content-start mb-2"></span>
							<p class="mb-0 text-left">Clientes</p>
						</a>
						<div class="card-footer p-0">
							<p class="p-0 mb-0 text-center h6" id="ncliente">0</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-venta mb-3">
						<a href="#" class="card-body btn p-3">
							<span class="fas fa-file-invoice-dollar fa-3x c-span d-flex justify-content-start mb-2"></span>
							<p class="mb-0 text-left">Ventas</p>
						</a>
						<div class="card-footer p-0">
							<p class="p-0 mb-0 text-center h6" id="nventas">0</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div id="grafica"></div>
				</div>
				<div class="col-md-6">
					<div id="graficaProductos"></div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	<input id="usuario" type="hidden" value="<?php echo $_SESSION['usuario']; ?>">	
	<script>
		var usuario= document.getElementById('usuario').value;
		//alert(usuario);
	
	</script>
	

    <script src="librerias/jquery-3.5.1.min.js"></script>
	<script src="librerias/alertify/alertify.js"></script>
	<script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="librerias/code/highcharts.js"></script>
	<script src="librerias/code/modules/exporting.js"></script>
	<script src="librerias/code/modules/export-data.js"></script>
	<script src="js/inicio.js"></script>
  </body>
</html>