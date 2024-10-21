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
    <title>Ventas</title>
	<link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="librerias/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="">
	
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
			<li class="nav-item"><a class="nav-link" href="inicio.php"><span class="fas fa-house-user mr-1"></span>Inicio</a></li>
			<li class="dropdown ml-2">
				<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><span class="fas fa-boxes mr-1"></span>Administrar Artículos</a>
			<ul class="dropdown-menu nav-item">
				<li><a class="dropdown-item" href="categorias.php">Categoria</a></li>
				<li><a class="dropdown-item" href="articulos.php">Articulos</a></li>
			</ul>
			</li>
			<li class="nav-item ml-2"><a class="nav-link" href="usuarios.php"><span class="fas fa-users mr-1"></span>Administrar Usuarios</a></li>
			<li class="nav-item ml-2"><a class="nav-link" href="clientes.php"><span class="fas fa-user-plus mr-1"></span>Clientes</a></li>
			<li class="nav-item ml-2 active"><a class="nav-link" href="#"><span class="fas fa-file-invoice-dollar mr-1"></span>Vender Artículo</a></li>
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
		<div class="container p-4">
			<div class="row">
				<div class="col-md-12 mb-2">
					<span class="btn btn-outline-info" id="venderArticuloBtn">Vender Producto</span>
					<span class="btn btn-outline-info" id="ventasHechasBtn">Ventas Hechas</span>
				</div>
			</div>

	<div id="venderProducto">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form id="form_venderProducto">
							<div class="form-group">
								<label><h6>Selecciona cliente</h6></label>
								<select class="form-control form-control-sm" id="selectCliente">
									<option value="A">Selecciona cliente</option>
								</select>
							</div>							
							<div class="form-group">
								<label><h6>Producto</h6></label>
								<select class="form-control form-control-sm" id="selectProducto">
									<option value="A">Selecciona producto</option>
								</select>
							</div>
							<div class="form-group">
								<label><h6>Descripción</h6></label>
								<textarea readOnly="" id="descripcionv" placeholder="Agrega descripción" class="form-control form-control-sm"></textarea>
							</div>
							<div class="form-group">
								<label><h6>Cantidad</h6></label>
								<input type="text" readOnly="" id="cantidadv" placeholder="Agrega cantidad" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label><h6>Precio</h6></label>
								<input type="text" readOnly="" id="preciov" placeholder="Agrega precio" class="form-control form-control-sm">
							</div>
							
							<span class="btn btn-primary btn-sm" id="bntAgregaVenta">Agregar</span>
							<span class="btn btn-danger btn-sm" id="btnVaciarTabla">Vaciar tabla</span>
						</form>
					</div>
				</div>								
			</div>
			<div class="col-md-2">
				<div id="imgProducto"></div>
			</div>
			<div class="col-md-6">
				<div id="tablaTempVenta">
					...
				</div>
			</div>
		</div>
	</div>

				<div id="ventasHechas">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<td>Folio</td>
										<td>Fecha</td>
										<td>Cliente</td>
										<td>Total de compra</td>
										<td>Ticket</td>
										<td>Reporte</td>
									</tr>
								</thead>
								<tbody id="bodyVentasHechas">
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
	</div>

    <script src="librerias/jquery-3.5.1.min.js"></script>
	<script src="librerias/alertify/alertify.js"></script>
	<script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="js/ventas.js"></script>
	<script src="js/vender-articulo.js"></script>
  </body>
</html>