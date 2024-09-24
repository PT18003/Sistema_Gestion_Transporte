<?php
require('funcion.php');
include('menuBar.php'); 

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SISTEMA DE MANTENIMIENTO</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>

<body>
<div class="container">
	<h4 class="page-header text-center">Ordenes de trabajo</h4>
	<div class="row">
		<div class="col-sm-12 col-sm-offset-0">
			<a href="./mantenimiento.php" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nuevo Registro</a>
			<a href="./consulta.php" class="btn btn-info" data-toggle="modal"><span class="glyphicon glyphicon-search"></span> Consultar Mantto</a>

<div>
<br><br>
<table id="example" class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	<thead>
				<tr>
					<th scope="col"> N°</th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Sucursal </th>
					<th scope="col"> Placa </th>
					<th scope="col"> Kms. </th>							
					<th scope="col"> Fecha </th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Tipo </th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Servicio </th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Prov </th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Nom Mecanico </th>
					<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Nom Recibio </th>
					<th scope="col"> Motivo Mantto </th>
					<th scope="col"> Det. </th>
				</tr>	
	</thead>
	<tfoot>
				<tr>
					<th scope="col"> N°</th>
					<th scope="col"> Sucursal </th>
					<th scope="col"> Placa </th>
					<th scope="col"> Kms. </th>							
					<th scope="col"> Fecha </th>
					<th scope="col"> Tipo </th>
					<th scope="col"> Servicio </th>
					<th scope="col"> Prov </th>
					<th scope="col"> Nom Mecanico </th>
					<th scope="col"> Nom Recibio </th>
					<th scope="col"> Motivo Mantto </th>
					<th scope="col"> Det. </th>
				</tr>	

	</tfoot>	
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT * FROM orden_rep O
				INNER JOIN asignacion A 
				ON ord_placa=tc_num_placa
				INNER JOIN sucursal S
				ON S.suc_id=A.suc_id
				INNER JOIN servicio E 
				ON E.serv_id=O.ord_obsv
				ORDER BY ord_fecha DESC';
				foreach ($db->query($sql) as $row) {
					?>
					<tr>
							<td> <?php echo $row['ord_num']; ?> </td>
							<td> <?php echo $row['suc_nombre']; ?> </td>
							<td> <?php echo $row['ord_placa']; ?> </td>
							<td> <?php echo $row['ord_km']; ?> </td>							
							<td> <?php echo $row['ord_fecha']; ?> </td>
							<td> <?php echo $row['ord_tipo']; ?> </td>
							<td> <?php echo $row['ord_serv']; ?> </td>
							<td> <?php echo $row['ord_prov']; ?> </td>
							<td> <?php echo $row['ord_mecanico']; ?> </td>
							<td> <?php echo $row['ord_recibe']; ?> </td>
							<td> <?php echo $row['serv_nombre']; ?> </td>
						<td>
						<?php $ord=$row['ord_num']; $tip=$row['ord_tipo']; ?>
							<a href="detalle.php?ord=<?php echo $ord; ?>&tip=<?php echo $tip; ?>" class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-info-sign" title="Detalle"></span> </a>
						</td>
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