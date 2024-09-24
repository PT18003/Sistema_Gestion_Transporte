<?php
require('funcion.php');
require('menuBar.php');

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<h4 class="page-header text-center">Servicios Mantenimiento</h4>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>
			<?php 
				if(isset($_SESSION['message'])){
					?>
					<div class="alert alert-info text-center" style="margin-top:20px;">
						<?php echo $_SESSION['message']; ?>
					</div>
					<?php

					unset($_SESSION['message']);
				}
			?>

		<div class="table-responsive">
		<br><br>
			<table id="example" class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
			<thead>
					<tr>
							<th scope="col"> Codigo </th>
							<th scope="col"> Nombre Servicio </th>
							<th scope="col"> Detalle Servicio </th>
							<th scope="col"> ACCION </th>
					</tr>
			</thead>
			<tfoot>
					<tr>
							<th scope="col"> Codigo </th>
							<th scope="col"> Nombre Servicio </th>
							<th scope="col"> Detalle Servicio </th>
							<th scope="col"> ACCION </th>
					</tr>		
			</tfoot>
			<tbody>
				<?php
					//incluimos el fichero de conexion
					include_once('dbconect.php');

					$database = new Connection();
					$db = $database->open();
					try{	
						$sql = 'SELECT * FROM servicio ORDER BY serv_id ASC';
						foreach ($db->query($sql) as $row) {
							?>
							<tr>
									<td> <?php echo $row['serv_id']; ?> </td>
									<td> <?php echo $row['serv_nombre']; ?> </td>
									<td><textarea class='form-control' rows='3' cols='10' style='textarea{resize: none;}'readonly><?php echo $row['serv_detalle']; ?></textarea></td>
									<td>
										<a href="#edit_<?php echo $row['serv_id']; ?>" class="btn btn-success btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-edit" title="Editar"></span> </a>
										<a href="#delete_<?php echo $row['serv_id']; ?>" class="btn btn-danger btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-trash" title="Borrar"></span> </a>							
									</td>
							<?php include('servicioEditarEliminar.php'); ?>		
							</tr>
							<?php 
						}
					}
					catch(PDOException $e){
						echo "Hubo un problema en la conexión: " . $e->getMessage();
					}

					//Cerrar la Conexion
					$database->close();

				?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<?php include('servicioAgregar.php'); ?>

<script src="bootstrap/js/bootstrap.min.js"></script>

<footer class="page-header text-center">
<hr>
Desarrollado x JRCO para SAVONA 2022.
</footer>
<?php
}
else
{
// Si la sesion expiro o no se creo  mostraremos el siguiente mensaje
	echo '<div class="text-center" style="position: relative;">';
	echo '<span style="font-size: 10rem; color: #E06666;" class="glyphicon glyphicon-remove-sign"></span>';
	echo '<p>Acceso denegado, vuleva a intentar</p>';
	echo '</div>';
}
?>
</body>
</html>