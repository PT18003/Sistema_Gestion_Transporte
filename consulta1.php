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
	<h4 class="page-header text-center">Licencias por Vencer</h4>
	<div class="row">

	<div class="col-sm-12 col-sm-offset-0">
		<a href="motoristas.php" class="btn btn-danger" ><span class="glyphicon glyphicon-share"></span> Salir </a>

		<div style="width:500px;">
			<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
			<tr><td>
				<form id="form1" action="consulta1.php" name="form1" method="post" >
				  <label class="control-label"> Seleccionar Mes-Año: </label>
				</td>
				<td>
					<select name="mes"class="form-control" style="width:100px;">
						<option value="">-</option>
						<option value="01">01-ENE</option>
						<option value="02">02-FEB</option>
						<option value="03">03-MAR</option>
						<option value="04">04-ABR</option>
						<option value="05">05-MAY</option>
						<option value="06">06-JUN</option>
						<option value="07">07-JUL</option>
						<option value="08">08-AGO</option>
						<option value="09">09-SEP</option>
						<option value="10">10-OCT</option>
						<option value="11">11-NOV</option>
						<option value="12">12-DIC</option>
					</select>
				</td>
				<td>	
					<input name="anio" type="number"  id="anio" placeholder="Ej.2022" class="form-control" style="width:100px;"/>
				</td>
				<td>
				  <input type="submit" class="btn btn-primary" name="consultar" value="Ok" />
				</form>
				</td>
			</tr>
			</table>
		</div>

<div class="table-responsive">
<br><br>
			<table id= "example" class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
				<thead>
					<tr>
							<th scope="col"> No.Licencia </th>
							<th scope="col"> No.DUI </th>
							<th scope="col"> Nombres </th>							
							<th scope="col"> Apellidos </th>
							<th scope="col"> Clase Lic. </th>
							<th scope="col"> F.Expedicion </th>
							<th scope="col"> F.Vencimiento </th>
					</tr>
				</thead>
				<tfoot>
					<tr>
							<th scope="col"> No.Licencia </th>
							<th scope="col"> No.DUI </th>
							<th scope="col"> Nombres </th>							
							<th scope="col"> Apellidos </th>
							<th scope="col"> Clase Lic. </th>
							<th scope="col"> F.Expedicion </th>
							<th scope="col"> F.Vencimiento </th>
					</tr>
				</tfoot>				
				<tbody>
					<?php
					//incluimos el fichero de conexion
					if(isset($_POST['consultar'])){
						date_default_timezone_set("America/El_Salvador");
						setlocale(LC_TIME, 'es_SV.UTF-8');
						include_once('dbconect.php');
						$mes=$_POST['mes'];
						$anio=$_POST['anio'];
						$dato=$anio."-".$mes;

						$database = new Connection();
						$db = $database->open();
						try{	
							$sql = "SELECT * FROM licencia
							WHERE lc_fec_vto like '%$dato%' ORDER BY lc_fec_vto DESC";
							foreach ($db->query($sql) as $row) {
								?>
								<tr>
										<td> <?php echo $row['lc_num']; ?> </td>
										<td> <?php echo $row['lc_dui']; ?> </td>
										<td> <?php echo $row['lc_nombres']; ?> </td>							
										<td> <?php echo $row['lc_apellidos']; ?> </td>
										<td> <?php echo $row['lc_clase']; ?> </td>
										<td> <?php echo $row['lc_fec_exp']; ?> </td>
										<td> <?php $fecha=strtotime($row['lc_fec_vto']);
										echo strtoupper(strftime('%b-%Y', $fecha)); ?> </td>
								</tr>
								<?php 
							}
					
						}
						catch(PDOException $e){
							echo "Hubo un problema en la conexión: " . $e->getMessage();
						}

						//Cerrar la Conexion
						$database->close();
					}
					?>
				</tbody>
			</table>	
			</div>
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