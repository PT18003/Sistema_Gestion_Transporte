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
	<h4 class="page-header text-center">Lista de Motoristas</h4>
	<div class="row">
		<div>
			<a href="#addnew_m" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>

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
<div>
<div class="table-responsive">
<br><br>
<table id="example" class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	<thead>				
			<tr>
				<th scope="col">NUMERO_LICENCIA</th>
				<th scope="col">NOMBRES_MOTORISTA</th>
				<th scope="col">APELLIDOS_MOTORISTA</th>
				<th scope="col">DUI_MOTORISTA</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">TRAMITE</th>
				<th scope="col">FECHA_EXP</th>
				<th scope="col">FECHA_NAC</th>
				<th scope="col">FECHA_VTO</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">CLASE_VEHICULO</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">OJOS</th>
				<th scope="col">ALTURA</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">TIPO_SANGRE</th>
				<th scope="col">EMAIL</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">GENERO</th>
				<th scope="col">NUM CONTROL</th>
				<th scope="col">MEDICACION</th>
				<th scope="col">ALERGICOS</th>
				<th scope="col">EMERGENCIA_AVISA</th>
				<th scope="col">TELEFONO</th>
				<th scope="col">DIRECCION_MOTORISTA</th>
			</tr>
	</thead>
	<tfoot>
			<tr>
				<th scope="col">NUMERO_LICENCIA</th>
				<th scope="col">NOMBRES_MOTORISTA</th>
				<th scope="col">APELLIDOS_MOTORISTA</th>
				<th scope="col">DUI_MOTORISTA</th>
				<th scope="col">TRAMITE</th>
				<th scope="col">FECHA_EXP</th>
				<th scope="col">FECHA_NAC</th>
				<th scope="col">FECHA_VTO</th>
				<th scope="col">CLASE_VEHICULO</th>
				<th scope="col">OJOS</th>
				<th scope="col">ALTURA</th>
				<th scope="col">TIPO_SANGRE</th>
				<th scope="col">EMAIL</th>
				<th scope="col">GENERO</th>
				<th scope="col">NUM CONTROL</th>
				<th scope="col">MEDICACION</th>
				<th scope="col">ALERGICOS</th>
				<th scope="col">EMERGENCIA_AVISA</th>
				<th scope="col">TELEFONO</th>
				<th scope="col">DIRECCION_MOTORISTA</th>
			</tr>		
	</tfoot>	
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT * FROM licencia';
				foreach ($db->query($sql) as $row) {
				?>
				<tr>
					<td> <?php echo $row['lc_num']; ?> </td>
					<td> <?php echo $row['lc_nombres']; ?> </td>
					<td> <?php echo $row['lc_apellidos']; ?> </td>
					<td> <?php echo $row['lc_dui']; ?> </td>
					<td> <?php echo $row['lc_tramite']; ?> </td>
					<td> <?php echo $row['lc_fec_exp']; ?> </td>
					<td> <?php echo $row['lc_fec_nac']; ?> </td>
					<td> <?php echo $row['lc_fec_vto']; ?> </td>
					<td> <?php echo $row['lc_clase']; ?> </td>
					<td> <?php echo $row['lc_ojos']; ?> </td>
					<td> <?php echo $row['lc_altura']; ?> </td>
					<td> <?php echo $row['lc_tiposangre']; ?> </td>
					<td> <?php echo $row['lc_email']; ?> </td>
					<td> <?php echo $row['lc_genero']; ?> </td>
					<td> <?php echo $row['lc_numcontrol']; ?> </td>
					<td> <?php echo $row['lc_medicacion']; ?> </td>
					<td> <?php echo $row['lc_alergico']; ?> </td>
					<td> <?php echo $row['lc_emer_avisar_a']; ?> </td>
					<td> <?php echo $row['lc_telefono']; ?> </td>
					<td> <?php echo $row['lc_direccion']; ?> </td>
					<?php include('BorrarEditarModal.php'); ?>
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
</div>
<?php include('AgregarModal_m.php'); ?>

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