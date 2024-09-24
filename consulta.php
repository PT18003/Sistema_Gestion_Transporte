<?php
session_start();
require('menuBar.php');

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
	<h4 class="page-header text-center">Mantenimiento Realizado</h4>
	<div class="row">

		<div class="col-sm-12 col-sm-offset-0">
		<a href="ordenes.php" class="btn btn-danger" ><span class="glyphicon glyphicon-share"></span> Salir </a>

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

<table class="table table-bordered table-striped table-hover table-sortable" style="margin-top:20px;">
	<thead>
							<th scope="col" data-table-sortable-disable> Doc.N° </th>
							<th scope="col"> Sucursal </th>
							<th scope="col"> Placa </th>
							<th scope="col"> Motivo </th>
							<th scope="col" data-table-sortable-type="number"> Kms. </th>							
							<th scope="col" data-table-sortable-type="date"> Fecha </th>
							<th scope="col"> Tipo </th>
							<th scope="col"> Servicio </th>
							<th scope="col"> Prov </th>
							<th scope="col"> Opcion </th>
							<th scope="col"> Item </th>
							<th scope="col" data-table-sortable-type="number"> Cant. </th>
							<th scope="col" data-table-sortable-type="number"> Monto </th>
							<th scope="col" data-table-sortable-type="number"> SubTotal </th>
	</thead>
	<tbody>
		<?php
			//incluimos el fichero de conexion
		if(isset($_POST['consultar'])){
			include_once('dbconect.php');
			$dato=$_POST['dato'];

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = "SELECT *,(det_cant*det_monto) AS Sub 
				FROM orden_rep
				INNER JOIN orden_det
				ON ord_num=det_ord
				INNER JOIN asignacion A 
				ON ord_placa=tc_num_placa
				INNER JOIN sucursal S
				ON S.suc_id=A.suc_id
				INNER JOIN servicio E
				ON E.serv_id=ord_obsv
				WHERE ord_placa LIKE '%$dato%'  ORDER BY ord_fecha DESC";
				foreach ($db->query($sql) as $row) {
					?>
					<tr>
							<td> <?php echo $row['ord_num']; ?> </td>
							<td> <?php echo $row['suc_nombre']; ?> </td>
							<td> <?php echo $row['ord_placa']; ?> </td>
							<td> <?php echo $row['serv_nombre']; ?> </td>
							<td> <?php echo $row['ord_km']; ?> </td>							
							<td> <?php echo $row['ord_fecha']; ?> </td>
							<td> <?php echo $row['ord_tipo']; ?> </td>
							<td> <?php echo $row['ord_serv']; ?> </td>
							<td> <?php echo $row['ord_prov']; ?> </td>
							<td> <?php echo $row['det_op']; ?> </td>
							<td> <?php echo $row['det_item']; ?> </td>
							<td> <?php echo $row['det_cant']; ?> </td>
							<td> <?php echo $row['det_monto']; ?> </td>
							<td> <?php echo $row['Sub']; ?> </td>
					</tr>
					<?php 
				}
				$sql2 = "SELECT SUM(det_cant)AS Cant, 
				SUM(det_cant*det_monto) AS Tot 
				FROM orden_rep O
				INNER JOIN orden_det D
				ON O.ord_num=D.det_ord
				WHERE ord_placa LIKE '%$dato%'";
				foreach ($db->query($sql2) as $row) {
					?>
					<tr>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>							
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo ""; ?> </td>
							<td> <?php echo "<H4>".$row['Cant']."</H4>"; ?> </td>
							<td> <?php echo "<H4>TOTAL </H4>"; ?> </td>
							<td> <?php echo "<H4>".$row['Tot']."</H4>"; ?> </td>
					</tr>
					<?php
				}

				$sql3 = "SELECT D.det_item AS Item, SUM(D.det_cant) AS Puntos
				FROM orden_rep AS O INNER JOIN orden_det AS D
				ON O.ord_num=D.det_ord
				WHERE O.ord_placa LIKE '%$dato%' AND (D.det_op='INSUMO' OR D.det_op='REPUESTO')
				GROUP BY D.det_item";
																
				foreach ($db->query($sql3) as $row) {
					$i=$row['Item'];
					$p=$row['Puntos'];
				?>
				<center>			
				<div class="row form-group">
					<div class="col-sm-3">
				<?php				
					echo "<p>$i</p>";
				?>
					</div>
					<div class="col-sm-6">
				<?php					
					echo "<input type='range' name='puntos' min='0' value='$p' disabled >";
				?>
					</div>
					<div class="col-sm-2">
				<?php						
					echo "<label>$p</label>";
				?>
					</div>
				</div>
				</center>
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




<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
<script src="js/jquery.min.js"></script>
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