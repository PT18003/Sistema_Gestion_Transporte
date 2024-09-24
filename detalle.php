<?php
require('funcion.php');
require('menuBar.php');

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";
?>	

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SISTEMA DE MANTENIMIENTO <?php echo $_GET['ord'];  ?></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<style>
.table{width:100%;} .cel1{width:15%;} .cel2{width:35%;}
</style>
<body>
<!-- Modal -->

<?php 
$x=$_GET['ord'];
$y=$_GET['tip']; 

switch ($y) {
    case 'INT':
?>
		<div class="page-header text-center">
		<h3>SAVONA S.A. DE C.V. </h3>
		<center><h4>Orden de Trabajo # <?php echo $_GET['ord'];  ?>	</h4></center>
		</div>
<?php       
	break;
    case 'EXT':
?>
		<div class="page-header text-center">
		<h3>SAVONA S.A. DE C.V. </h3>
		<center><h4>Requisicion # <?php echo $_GET['ord'];  ?>	</h4></center>
		</div><?php
	break;
}
?>	


<div class="col-sm-10 col-sm-offset-1">
	<a href="ordenes.php" class="btn btn-danger" ><span class="glyphicon glyphicon-share"></span> Salir </a>
	<a href="javascript:window.print()" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

	<?php
		//incluimos el fichero de conexion
		include_once('dbconect.php');

		$database = new Connection();
		$db = $database->open();
		try{	
			$sql = "SELECT * FROM orden_rep O
			INNER JOIN servicio S
			ON S.serv_id=O.ord_obsv
			WHERE ord_num=$x";
		foreach ($db->query($sql) as $row) {
		$num=$row['ord_num'];
		$fec=$row['ord_fecha'];
		$pla=$row['ord_placa'];
		$kms=$row['ord_km'];
		$ser=$row['ord_serv'];
		$mec=$row['ord_mecanico'];
		$rec=$row['ord_recibe'];
		$asn=$row['asn_id'];
		$lic=$row['lic_num'];
		$mot=$row['lic_motorista'];
		$com=$row['serv_nombre'];
	?>
	
	<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	  <tr>
		<td class="cel1" colspan=""><label class="control-label"> No. Orden: </label></td>
		<td class="cel2" colspan="3"><label class="control-label">No. <?php echo $num;; ?> </label></td>
		<td class="cel1" colspan=""><label class="control-label"> Fecha: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $fec; ?> </label></td>
	  </tr>
	  <tr>
		<td class="cel1" colspan=""><label class="control-label"> Num Placa: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $pla; ?> </label></td>		
		<td class="cel1" colspan=""><label class="control-label"> Kilometraje: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $kms; ?> KMS </label></td>
	  </tr>   
	  <tr>
		<td class="cel1" colspan=""><label class="control-label"> Servicio: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $ser; ?> </label></td>
		<td class="cel1" colspan=""><label class="control-label"> Nom.Mecanico: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $mec; ?> </label></td>
	  </tr>
	  <tr> 
		<td class="cel1" colspan=""><label class="control-label"> Id Asignacion: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $asn; ?> </label></td>		  
		<td class="cel1" colspan=""><label class="control-label"> Nom.Recibe: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $rec; ?> </label></td>  
	  </tr>  
	  <tr>  
		<td class="cel1" colspan=""><label class="control-label"> Licencia: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $lic; ?> </label></td>
		<td class="cel1" colspan=""><label class="control-label"> Motorista: </label></td>
		<td class="cel2" colspan="3"><label class="control-label"><?php echo $mot; ?> </label></td>	  
	  </tr>
	  <tr>  
		<td class="cel1" colspan=""><label class="control-label"> Motivo: </label></td>
		<td class="cel2" colspan="6"><label class="control-label"><?php echo $com; ?> </label></td>
	  </tr>  	  
	  </table>
	<?php 
				}
			}
			catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
			}

			//Cerrar la Conexion
			$database->close();
?>
	<!--  descripcion de servisicios -->
	<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	  <tr>	
		<td colspan="6" style='text-align:center; background-color:#e0e0e0;'>
			<h4>Detalle de Requisicion</h4>
		</td>
	  </tr>
	  <tr>
		<td><b>No.</td>
		<td><b>Tipo:</td>
		<td><b>Detalle Repuestos:</td>
		<td><b>Cantidad:</td>
		<td><b>Monto:</td>
		<td><b>Subtotal:</td>
	  </tr>
	  	<?php
		//incluimos el fichero de conexion
		include_once('dbconect.php');

		$database = new Connection();
		$db = $database->open();
		try{	
			$sql = "SELECT * FROM orden_det WHERE det_ord=$x AND det_detalle='REQ'";
		$n=0;
		foreach ($db->query($sql) as $row) {
		$n++;	
		$did=$row['det_id'];
		$dord=$row['det_ord'];
		$ddet=$row['det_detalle'];
		$ditm=$row['det_item'];
		$dop=$row['det_op'];
		$can=$row['det_cant'];
		$mon=$row['det_monto'];
		?>
		  <tr>
			<td><?php echo $n; ?></td>
			<td><?php echo $dop; ?></td>
			<td><?php echo $ditm; ?></td>
			<td><?php echo $can; ?></td>
			<td><?php echo "$ ".$mon; ?></td>
			<?php $sub=$mon*$can; ?>
			<td><?php echo "$ ".number_format($sub, 2, '.', ''); ?></td>
		  </tr>		
		<?php 
		}
			$sqls = "SELECT SUM(det_cant) AS acumulado,SUM(det_cant*det_monto) AS total FROM orden_det WHERE det_ord=$x AND det_detalle='REQ'";
		$n=0;
		foreach ($db->query($sqls) as $row) {
		$n++;	
		$acu=$row['acumulado'];
		$tot=$row['total'];
		}
		?>
		  <tr>
			<td> </td>
			<td> </td>
			<td> </td>
			<td><h4><?php echo $acu; ?> </h4></td>
			<td><h4>Total:</h4></td>
			<td><h4><?php echo "$ ".number_format($tot, 2, '.', ''); ?></h4></td>
		  </tr>		
		<?php 		
			
			}
			catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
			}

			//Cerrar la Conexion
			$database->close();

		?>
	  
	</table>  	  	
</div>
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