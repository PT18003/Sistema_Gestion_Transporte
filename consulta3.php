<?php
require('funcion.php');
require('menuBar.php');

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";
?>	
<!DOCTYPE html>
<html>
<head>
		<link type="text/css" rel="stylesheet" href="bootstrap/css/style.css"/>
        <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container">
	<h4 class="page-header text-center">Estado de Mantenimientos</h4>
	<div class="row">

		<div class="col-sm-12 col-sm-offset-0">
		<a href="ordenes.php" class="btn btn-danger" ><span class="glyphicon glyphicon-share"></span> Salir </a>

<!--
			<div style="width:500px;">
			<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
			<tr><td>
				<form id="form1" action="consulta.php" name="form1" method="post" >
				  <label class="control-label"> DIgite N° de Placa a consultar: </label>
				</td>
				<td>
				  <input name="dato" type="text"  id="dato" placeholder="Ej.: M######-####" class="form-control"/>
				</td>
				<td>
				  <input type="submit" class="btn btn-primary" name="consultar" value="Ok" />
				</form>
				</td>
			</tr>
			</table>
			</div>
-->			

<h4> Resumen de mantenimientos </h4>
	<div>
			<table id="example" class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
				<thead>
					<tr>
							<th scope="col"> #</th>
							<th scope="col"> Sucursal</th>
							<th scope="col"> Placa </th>
							<th scope="col"> Kms Actual </th>
							<th scope="col"> Prox. Mantto </th>
							<th scope="col"> Diferencial</th>
							<th scope="col"> Fecha Ult. Mantto </th>
							<th scope="col"> Ult. Mantto </th>							
					</tr>
				</thead>
				<tfoot>
					<tr>
							<th scope="col"> #</th>
							<th scope="col"> Sucursal</th>
							<th scope="col"> Placa </th>
							<th scope="col"> Kms Actual </th>
							<th scope="col"> Prox. Mantto </th>
							<th scope="col"> Diferencial</th>
							<th scope="col"> Fecha Ult. Mantto </th>
							<th scope="col"> Ult. Mantto </th>							
					</tr>			
				</tfoot>
				<tbody>
		<?php
				//incluimos el fichero de conexion
		//	if(isset($_POST['consultar'])){
				include_once('dbconect.php');
		//		$dato=$_POST['dato'];

				$database = new Connection();
				$db = $database->open();
				try{
					$num=0;
					$sql = "
					SELECT (E.serv_nombre)AS servP,
					S.suc_nombre, A.tc_num_placa, A.asn_kilometraje,
					A.mantto_prox,(A.mantto_prox-A.asn_kilometraje)AS Dif,
					MAX(O.ord_fecha)AS Fecha_Mantto, IF(O.ord_obsv,CONCAT('SERVICIO DE ',MAX(O.ord_obsv),' KMS'),'NULL')AS Motivo 
					FROM orden_rep O 
					RIGHT JOIN asignacion A
					ON O.ord_placa=A.tc_num_placa
					INNER JOIN sucursal S
					ON A.suc_id=S.suc_id
					INNER JOIN servicio E
					ON A.mantto_prox=E.serv_id
					WHERE A.mantto_prox < A.asn_kilometraje
					GROUP BY A.tc_num_placa
					ORDER BY Dif ASC				
					";
					foreach ($db->query($sql) as $row) {
						$num++;
						?>
						<tr>
								<td> <?php echo $num; ?> </td>
								<td> <?php echo $row['suc_nombre']; ?> </td>
								<td> <?php echo $row['tc_num_placa']; ?> </td>
								<td> <?php echo $row['asn_kilometraje']; ?> </td>
								<td><b> <?php echo $row['servP']; ?> </b></td>
								<td style="background-color:#ffc7c7"> <?php echo $row['Dif']; ?> </td>
								<td> <?php echo $row['Fecha_Mantto']; ?> </td>														
								<td> <?php echo $row['Motivo']; ?> </td>
						</tr>
						<?php 
					}
					
				}
				catch(PDOException $e){
					echo "Hubo un problema en la conexión: " . $e->getMessage();
				}

				//Cerrar la Conexion
				$database->close();
		//	}
		?>

	<?php
			//incluimos el fichero de conexion
	//	if(isset($_POST['consultar'])){
			include_once('dbconect.php');
	//		$dato=$_POST['dato'];

			$database = new Connection();
			$db = $database->open();
			try{	
				$num=0;
				$sql = "
				SELECT (E.serv_nombre)AS servP,
				S.suc_nombre,A.tc_num_placa, A.asn_kilometraje,
				A.mantto_prox,(A.mantto_prox-A.asn_kilometraje)AS Dif,
				MAX(O.ord_fecha)AS Fecha_Mantto, IF(O.ord_obsv,CONCAT('SERVICIO DE ',MAX(O.ord_obsv),' KMS'),'NULL')AS Motivo 
				FROM orden_rep O 
				RIGHT JOIN asignacion A
				ON O.ord_placa=A.tc_num_placa
				INNER JOIN sucursal S
				ON A.suc_id=S.suc_id
				INNER JOIN servicio E
				ON A.mantto_prox=E.serv_id				
				WHERE A.mantto_prox>A.asn_kilometraje
				GROUP BY A.tc_num_placa
				ORDER BY Dif ASC
				";
				foreach ($db->query($sql) as $row) {
					$num++;
					?>
						<tr>
								<td> <?php echo $num; ?> </td>
								<td> <?php echo $row['suc_nombre']; ?> </td>
								<td> <?php echo $row['tc_num_placa']; ?> </td>
								<td> <?php echo $row['asn_kilometraje']; ?> </td>
								<td><b> <?php echo $row['servP']; ?> </b></td>
								<td style="background-color:#b2ff98"> <?php echo $row['Dif']; ?> </td>
								<td> <?php echo $row['Fecha_Mantto']; ?> </td>														
								<td> <?php echo $row['Motivo']; ?> </td>
						</tr>
					<?php 
				}

				
			}
			catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
			}

			//Cerrar la Conexion
			$database->close();
	//	}
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