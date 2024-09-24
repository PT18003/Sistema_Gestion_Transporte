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
	<h4 class="page-header text-center">Asignacion de Vehiculos</h4>
	<div class="row">
		<div class="col-sm-0 col-sm-offset-0">
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>
			<?php 

				if(isset($_SESSION['message'])){
					?>
					<div class="alert alert-info text-center" style="margin-top:20px;">
						<?php echo $_SESSION['message']; ?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>					
					</div>
					<?php

					unset($_SESSION['message']);
				}
			?>
			<div>
			<div class="table-responsive">
			<br><br>
				<table id="example" class="table table-bordered table-hover" style="margin-top:20px;">
					<thead>
							<tr>
                                <th scope="col"> ID </th>
                                <th scope="col"> Num Placa </th>								
								<th scope="col"> Fecha </th>
                                <th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Estado </th>
								<th scope="col"> Kms </th>
								<th scope="col"> Gals </th>
                                <th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Tipo </th>
								<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Vehiculo </th>
								<th scope="col"> Num Lic </th>
								<th scope="col"> Motorista </th>
								<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Ruta </th>
								<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Suc </th>
                                <th scope="col"> Accion </th>
							</tr>	
					</thead>
					<tfoot>
							<tr>
                                <th scope="col"> ID </th>
                                <th scope="col"> Num Placa </th>								
								<th scope="col"> Fecha </th>
                                <th scope="col"> Estado </th>
								<th scope="col"> Kms </th>
								<th scope="col"> Gals </th>
                                <th scope="col"> Tipo </th>
								<th scope="col"> Vehiculo </th>
								<th scope="col"> Num Lic </th>
								<th scope="col"> Motorista </th>
								<th scope="col"> Ruta </th>
								<th scope="col"> Suc </th>
                                <th scope="col"> Accion </th>
							</tr>					
					</tfoot>					
					<tbody>
						<?php
							//incluimos el fichero de conexion
							include_once('dbconect.php');

							$database = new Connection();
							$db = $database->open();
							try{	
								$sql = 'SELECT A.asn_id,
										A.asn_fecha,
										A.asn_disposicion,
										A.asn_kilometraje,
										A.asn_combustible,
										A.tpt_codigo,
										A.tc_num_placa,
										A.mot_id_conductor,
										A.rut_id,
										A.suc_id,
										R.rut_nombre,
										S.suc_nombre,
										T.tpt_nombtre,
										L.lc_nombres,
										L.lc_apellidos,
										P.tc_marca,
										P.tc_modelo,
										P.tc_anio_vehiculo
										FROM asignacion A 
										INNER JOIN ruta R
										ON A.rut_id = R.rut_id
										INNER JOIN sucursal S
										ON A.suc_id = S.suc_id
										INNER JOIN tipo_transporte T
										ON A.tpt_codigo = T.tpt_codigo
										INNER JOIN licencia L
										ON A.mot_id_conductor = L.lc_num
										INNER JOIN tar_circulacion P
										ON A.tc_num_placa = P.tc_numplaca
										ORDER BY A.asn_id ASC;';
								foreach ($db->query($sql) as $row) {
									?>
									<tr>
											<td> <?php echo $row['asn_id']; ?> </td>
											<td> <?php echo $row['tc_num_placa']; ?> </td>											
											<td> <?php echo $row['asn_fecha']; ?> </td>
											<td> <?php echo $row['asn_disposicion']; ?> </td>
											<td> <?php echo $row['asn_kilometraje']; ?> </td>
											<td> <?php echo $row['asn_combustible']; ?> </td>
											<td> <?php echo $row['tpt_nombtre']; ?> </td>
											<td> <?php echo $row['tc_marca']." ".$row['tc_modelo']." ".$row['tc_anio_vehiculo']; ?> </td>
											<td> <?php echo $row['mot_id_conductor']; ?> </td>
											<td> <?php echo $row['lc_nombres']." ".$row['lc_apellidos']; ?> </td>
											<td> <?php echo $row['rut_nombre']; ?> </td>
											<td> <?php echo $row['suc_nombre']; ?> </td>
											<td>
										<?php	$row['rut_nombre']; $row['suc_nombre']; $row['tpt_nombtre']; ?>
												<a href="#edit_<?php echo $row['asn_id']; ?>" class="btn btn-success btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-edit" title="Editar"></span> </a>
												<a href="#ver_<?php echo $row['asn_id']; ?>" class="btn btn-warning btn-xs" data-toggle="modal"><span class="glyphicon glyphicon glyphicon-exclamation-sign" title="Revisar"></span> </a>
											</td>
										<?php 
										require('BorrarEditarModal.php');
										require('VerServicio.php'); 
										?>
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
<?php include('AgregarModal.php'); ?>

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