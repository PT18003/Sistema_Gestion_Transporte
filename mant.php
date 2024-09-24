<?php
error_reporting(0);
require('funcion_m.php');
require('menuBar.php');
require_once('conexion.php'); 

$cantidad=0;
if( isset( $_POST["submit"] ) ){ 
 $ord=$_POST['orden'];
 $tip=$_POST['tipo'];
 $fec=$_POST['fecha'];
 $pla=$_POST['placa'];
 $kil=$_POST['kilo'];
 $ser=$_POST['serv'];
 $prv=$_POST['proveedor']; 
 $mec=$_POST['meca'];
 $rec=$_POST['reci'];
 $obs=$_POST['motivo'];

 //agregar informacion adicional a la orden 
 $select="SELECT A.asn_id, A.mot_id_conductor,
 CONCAT(L.lc_nombres,' ', L.lc_apellidos) AS lc_mot 
 FROM asignacion A INNER JOIN licencia L 
 ON A.mot_id_conductor = L.lc_num WHERE A.tc_num_placa='$pla'";
 $resultset = mysqli_query($connection,$select); 
 while( $rows = mysqli_fetch_assoc($resultset)){
 $idasn=$rows['asn_id'];
 $lic=$rows['mot_id_conductor'];
 $mot=$rows['lc_mot'];
 }
//inserta el registro de orden 
 $consulta="INSERT INTO orden_rep (ord_num, ord_tipo, ord_fecha, ord_placa, ord_km, ord_serv, ord_prov, ord_mecanico, ord_recibe, asn_id, lic_num, lic_motorista, ord_obsv) 
 VALUES ('$ord','$tip','$fec','$pla','$kil','$ser','$prv','$mec','$rec','$idasn','$lic','$mot','$obs')";
 mysqli_query($connection,$consulta);
 
 //seleccionar servicio proximo
 $serv="SELECT * FROM servicio WHERE serv_id>'$obs' LIMIT 1";
 $reserv = mysqli_query($connection,$serv); 
 while( $rows = mysqli_fetch_assoc($reserv)){
 $prox=$rows['serv_id'];
 }
 mysqli_free_result($reserv);
 
//actualiza el kilometraje de la asignacion 
 $update="UPDATE asignacion SET mantto_prox='$prox' WHERE tc_num_placa='$pla'";
 mysqli_query($connection,$update);  
 



 /*
//inserta el registro de recorrido
 $consulta2="INSERT INTO recorrido (rec_fecha, rec_placa, rec_km, rec_kmAnt) 
 VALUES ('$fec','$pla','$kil','$ant')";
 mysqli_query($connection,$consulta2);
*/


for($x =0 ; $x <= $_POST['cantidad'] ; $x++) 
if(isset($_POST["num" . $x])) {
 $item=  $_POST["item".$x ];
 $det=  $_POST["detalle".$x ];
 $opc=$_POST["opcion".$x ];
 $can=$_POST["cant".$x ];
 $mon=$_POST["monto".$x ];
 
//inserta los registros del detalle de la orden 
 $consulta2="INSERT INTO orden_det (det_ord, det_detalle, det_item, det_op, det_cant, det_monto) 
 VALUES ('$ord','$det','$item','$opc','$can','$mon')";
 mysqli_query($connection,$consulta2);
}

 
header("location:ordenes.php");
}

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="modal-header">
		<center><h4 class="modal-title" id="myModalLabel">Nueva Orden de Mantenimiento</h4></center>
	</div>
	<div style="width:450px;">
	<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	<tr><td>
		<form id="form1" name="form1" method="post" >
		  <label class="control-label"> No. de Items a Registrar: </label>
		</td>
		<td>
		  <input name="cantidad" type="number" min="1" max="37" id="cantidad" value="1" class="form-control" onClick="this.select();"/>
		</td>
		<td>
		  <input type="submit" class="btn btn-primary" name="Submit" value="Ok" />
		</form>
		</td>
	</tr>
	</table>
	</div>

<?php 
$cant=1; 
if($cant>0){ 
	
//seleccionar km anterior
 $n="SELECT MAX(ord_num+1) AS num FROM orden_rep";
 $qnum = mysqli_query($connection,$n); 
 while( $rows = mysqli_fetch_assoc($qnum)){
 $num=$rows['num'];
 }
 mysqli_free_result($qnum);
?>	
	
	<form method="POST">
	<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	  <tr>
		<td colspan=""><label class="control-label"> Tipo: </label></td>
		<td colspan="2">
		<select  name="tipo" id="tipo" class="form-control" required >
			<option value="">SELECCIONAR TIPO</option>
			<option value="INT">SERVICIO INTERNO</option>
			<option value="EXT">SERVICIO EXTERNO</option>			
		</select>
		</td>
		
		<td colspan=""><label class="control-label"> No. Orden / Requi: </label></td>
		<td colspan="2"><input type="number" name="orden" min="1" value="<?php echo $num; ?>" id="orden" class="form-control" onClick="this.select();" required ></td>
	  </tr>	  

	  <tr>
		<td colspan=""><label class="control-label"> Proveedor: </label></td>
		<td colspan="2">
			<select name="proveedor" id="proveedor" class="form-control" required="required" >
				<option value="" selected="selected">SELECCIONAR PROVEEDOR</option>
				<?php
				$sql = "SELECT prov_id, prov_nombre FROM proveedor ORDER BY prov_nombre ASC";
				$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($conn));
				while( $rows = mysqli_fetch_assoc($resultset) ) { 
				?>
				<option value="<?php echo $rows["prov_id"]; ?>"><?php echo $rows["prov_nombre"]; ?></option>
				<?php }	?>
			</select>
		</td>	
		
		<td colspan=""><label class="control-label"> Fecha: </label></td>
		<td colspan="2"><input type="date" name="fecha" id="fecha" class="form-control" required ></td>
	  </tr>	 
	  
	  <tr>
		<td colspan=""><label class="control-label"> Num Placa: </label></td>
		<td colspan="2"><input class="form-control" id="search" type="text" name="placa" onClick="this.select();" pattern="[0A-Z]{1}[0-9]{6}-[0-9]{4}" title="Ej.: M012345-2011" placeholder="Ej: M######-####" required="required" /></td>		
		<td colspan=""><label class="control-label"> Kilometraje: </label></td>
		<td colspan="2"><input type="number" name="kilo" min="1" id="kilo" class="form-control" onClick="this.select();" required ></td>
	  </tr>
	    
	  <tr>
		<td colspan=""><label class="control-label"> Servicio: </label></td>
		<td colspan="2">
		<select name="serv" class="form-control" required>
			<option value="REV_GRL">REVISION GENERAL</option>
			<option value="MAN_PRE">MANTENIMIENTO PREVENTIVO</option>
			<option value="MAN_COR">MANTENIMIENTO CORRECTIVO</option>
		</select>
		</td>
		
		<td colspan=""><label class="control-label"> Nom.Mecanico: </label></td>
		<td colspan="2"><input type="text" name="meca" id="meca" class="form-control" onClick="this.select();" required ></td>
	  </tr>

	  <tr>  
		<td colspan=""><label class="control-label"> Motivo Mantto: </label></td>
		<td colspan="2">
			<select name="motivo" id="motivo" class="form-control" required="required" >
				<option value="" selected="selected">SELECCIONAR SERVICIO</option>
				<?php
				$sql = "SELECT serv_id, serv_nombre FROM servicio ORDER BY serv_id ASC";
				$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($conn));
				while( $rows = mysqli_fetch_assoc($resultset) ) { 
				?>
				<option value="<?php echo $rows["serv_id"]; ?>"><?php echo $rows["serv_nombre"]; ?></option>
				<?php }	?>
			</select>
		</td>
		<td colspan=""><label class="control-label"> Nom.Recibe: </label></td>
		<td colspan="2"><input type="text" name="reci" id="reci" class="form-control" onClick="this.select();" required ></td>
	  </tr>  
	  <tr>
	  <td colspan="6" style='text-align:center; background-color:#e0e0e0;'>
	  <h4>Detalle de los servicios a realizar</h4>
	  </td></tr>
	  <tr>
		<td>No.</td>
		<td colspan="">Tipo de Detalle</td>
		<td>Opcion Requerida:</td>
		<td>Nombre Servicio:</td>
		<td>Cantidad:</td>
		<td>Monto:</td>
	  </tr>
	  <?php
	  if( isset( $_POST["cantidad"] ) ){
		$cantidad=1;
		While($cantidad<=$_POST['cantidad']){ 
	  ?>

	  <tr>
		<td><?php echo "$cantidad"; ?></td>
		<td colspan="">
			<select name="detalle<?php echo "$cantidad";?>" class="form-control" required="required">
		<!--	<option value="DSR">DESCRIPCION SERVICIO A REALIZAR</option>	-->
				<option value="REQ">REQUISICION</option>				
				<option value="REU">REPUESTOS UTILIZADOS</option>
		<!--	<option value="NEP">NECESIDADES PENDIENTES</option>				-->

			</select>		
		</td>		
		<td colspan="">
			<select name="opcion<?php echo "$cantidad";?>" class="form-control" required="required">
				<option value="CAMBIO">CAMBIO</option>
				<option value="CALIBRACION">CALIBRACION</option>
				<option value="ENGRASE">ENGRASE</option>
				<option value="INSUMO">INSUMO</option>
				<option value="LIMPIEZA">LIMPIEZA</option>
				<option value="LUBRICACION">LUBRICACION</option>
				<option value="REGULACION">REGULACION</option>
				<option value="REVISION">REVISION</option>
				<option value="REPUESTO">REPUESTO</option>
				<option value="PENDIENTE">PENDIENTE</option>
			</select>		
		</td>
		<td width="">
			<select name="item<?php echo "$cantidad";?>" id="item" class="form-control" required="required" >
				<option value="" selected="selected">SELECCIONAR ITEM</option>
				<?php
				$sql = "SELECT par_codigo, par_nombre FROM partes ORDER BY par_nombre ASC";
				$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($conn));
				while( $rows = mysqli_fetch_assoc($resultset) ) { 
				?>
				<option value="<?php echo $rows["par_nombre"]; ?>"><?php echo $rows["par_nombre"]; ?></option>
				<?php }	?>
			</select>
		</td>

			<td colspan=""><input type="number" name="cant<?php echo "$cantidad";?>" id="cant" min="1" value="1" class="form-control" onClick="this.select();" required ></td>

			<td colspan=""><input type="number" name="monto<?php echo "$cantidad";?>" id="monto" min="0" value="0" step="0.01" class="form-control" onClick="this.select();" required ></td>

		
			<input name="num<?php echo "$cantidad"; ?>" type="hidden">
			<input name="cantidad" type="hidden" id="cantidad" value="<?php echo "$_POST[cantidad]"; ?>" />
	<?php
	$cantidad++;
	}
	  }
	?>
	  </tr>
	  <tr>
		<td colspan="6" align="right">
		<button type ="submit" class="btn btn-success" name="submit" >Guardar</button>
		</td>
	<?php } ?>  
	  </tr>
	</table>
	</form>
</div>
</body>
<script src="js/jquery-ui.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#search").autocomplete({
			source: 'search.php',
			minLength: 0,
		});
	});
</script>
</html>