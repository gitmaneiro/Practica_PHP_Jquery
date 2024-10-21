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
    <title>Categorias</title>
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
			<li class="dropdown ml-2 active">
				<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><span class="fas fa-boxes mr-1"></span>Administrar Artículos</a>
			<ul class="dropdown-menu nav-item">
				<li><a class="dropdown-item" href="#">Categoria</a></li>
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
		<div class="container p-4">
			<div class="row">
				<div class="col-md-5">
					<div class="card">
						<div class="card-body">
						<form id="form_categorias">
							<div class="form-group">
								<label><h6>Categoria</h6></label>
								<input type="hidden" id="idUsuario" value="">
								<input type="hidden" id="idCategoria" value="">
								<input type="text" id="categoria" placeholder="Agrega categoria" class="form-control form-control-sm">
							</div>
							<button type="submit" class="btn btn-primary btn-sm">Agregar</button>
						</form>
						</div>
					</div>

				</div>
				<div class="col-md-7">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td>Categoria</td>
								<td>Editar</td>
								<td>Eliminar</td>
							</tr>
						</thead>
						<tbody id="categorias">
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
<!-- Modal actualizar -->
<div class="modal fade" id="actualizarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="form_actualizar_categorias">
			<div class="form-group">
					<input type="hidden" id="idUsuario" value="">
					<input type="hidden" id="midCategoria" value="">
					<input type="text" id="actualizacategoria" placeholder="Agrega categoria" class="form-control form-control-sm" value="">
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="actualizar" class="btn btn-primary btn-sm" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>
	<input type="hidden" id="nombreusuario" value="<?php echo $_SESSION['usuario']; ?>"> 
    <script src="librerias/jquery-3.5.1.min.js"></script>
	<script src="librerias/alertify/alertify.js"></script>
	<script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="js/administrarArticulo.js"></script>
  </body>
</html>