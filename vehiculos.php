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
	<h4 class="page-header text-center">Lista de Vehiculos</h4>
	<div class="row">
		<div>
			<a href="#addnew_v" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>

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
				<th scope="col">NUMERO_PLACA </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">PROPIETARIO	</th>
				<th scope="col">NIT_DE_REGISTRO	</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">DEPARTAMENTO </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">MUNICIPIO_REG </th>
				<th scope="col">FEC_VETO </th>
				<th scope="col">FEC_EMI	</th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">AÑO </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">MARCA </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">MODELO </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar">CAPACIDAD </th>
				<th scope="col">TIPO </th>
				<th scope="col">CLASE </th>
				<th scope="col">DOMINIO	</th>
				<th scope="col">ENCALIDAD </th>
				<th scope="col">COLOR </th>
				<th scope="col">NUM_CHASIS </th>
				<th scope="col">NUM_MOTOR </th>
				<th scope="col">NUMERO_DE_VIN	</th>
			</tr>
	</thead>
	<tfoot>
			<tr>
				<th scope="col">NUMERO_PLACA </th>
				<th scope="col">PROPIETARIO	</th>
				<th scope="col">NIT_DE_REGISTRO	</th>
				<th scope="col">DEPARTAMENTO </th>
				<th scope="col">MUNICIPIO_REG </th>
				<th scope="col">FEC_VETO </th>
				<th scope="col">FEC_EMI	</th>
				<th scope="col">AÑO </th>
				<th scope="col">MARCA </th>
				<th scope="col">MODELO </th>
				<th scope="col">CAPACIDAD </th>
				<th scope="col">TIPO </th>
				<th scope="col">CLASE </th>
				<th scope="col">DOMINIO	</th>
				<th scope="col">ENCALIDAD </th>
				<th scope="col">COLOR </th>
				<th scope="col">NUM_CHASIS </th>
				<th scope="col">NUM_MOTOR </th>
				<th scope="col">NUMERO_DE_VIN	</th>
			</tr>
		</tfoot>
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT * FROM tar_circulacion';
				foreach ($db->query($sql) as $row) {
					?>
					<tr>	
						<td> <?php echo $row['tc_numplaca']; ?> </td>
						<td> <?php echo $row['tc_propietario']; ?> </td>
						<td> <?php echo $row['tc_nit']; ?> </td>
						<td> <?php echo $row['tc_departamento']; ?> </td>
						<td> <?php echo $row['tc_municipio']; ?> </td>
						<td> <?php echo $row['tc_fec_veto']; ?> </td>
						<td> <?php echo $row['tc_fec_emi']; ?> </td>
						<td> <?php echo $row['tc_anio_vehiculo']; ?> </td>
						<td> <?php echo $row['tc_marca']; ?> </td>
						<td> <?php echo $row['tc_modelo']; ?> </td>
						<td> <?php echo $row['tc_capacidad']; ?> </td>
						<td> <?php echo $row['tc_tipo']; ?> </td>
						<td> <?php echo $row['tc_clase']; ?> </td>
						<td> <?php echo $row['tc_dominio']; ?> </td>
						<td> <?php echo $row['tc_encalidad']; ?> </td>
						<td> <?php echo $row['tc_color']; ?> </td>
						<td> <?php echo $row['tc_num_chasis']; ?> </td>
						<td> <?php echo $row['tc_num_motor']; ?> </td>
						<td> <?php echo $row['tc_num_vin']; ?> </td>
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
<?php include('AgregarModal_v.php'); ?>

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