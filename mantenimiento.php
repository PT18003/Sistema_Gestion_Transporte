<?php
error_reporting(0);
require('funcion_m.php');
require_once('conexion.php'); 
include('menuBar.php'); 

if(isset($_POST['login'])){
	$u=$_POST['user'];
	$p=$_POST['pass'];
		
	$res = mysqli_query($connection,"SELECT * FROM usuario WHERE us_nickname='$u'and us_clave='$p'");
	$result=mysqli_fetch_array($res);
	if($result)
	{
	$_SESSION['user'] = $_POST['user'];	
	}

//echo "Bienvenido!:<b> ".$_POST['user']."</b>";
}	

if(isset($_SESSION['user'])){
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";

	if(!empty($_POST["guardar"])) {
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
 $select="SELECT A.asn_id, A.mot_id_conductor,A.mantto_prox,
 CONCAT(L.lc_nombres,' ', L.lc_apellidos) AS lc_mot 
 FROM asignacion A INNER JOIN licencia L 
 ON A.mot_id_conductor = L.lc_num WHERE A.tc_num_placa='$pla'";
 $resultset = mysqli_query($connection,$select); 
 while( $rows = mysqli_fetch_assoc($resultset)){
 $idasn=$rows['asn_id'];
 $lic=$rows['mot_id_conductor'];
 $mot=$rows['lc_mot'];
 $mantto=$rows['mantto_prox'];
 }
 if($obs>=$mantto){
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
 
 
 		$contador = count($_POST["pro_nombre"]);
		$ProContador=0;
		$query = "INSERT INTO orden_det (det_ord, det_detalle, det_item, det_op, det_cant, det_monto) VALUES ";
		$queryValue = "";
		for($i=0;$i<$contador;$i++) {
			if(!empty($_POST["pro_detalle"][$i]) || !empty($_POST["pro_nombre"][$i]) || !empty($_POST["pro_opcion"][$i]) || !empty($_POST["pro_cantidad"][$i]) || !empty($_POST["pro_precio"][$i])) {
				$ProContador++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('". $ord ."','" . $_POST["pro_detalle"][$i] . "','" . $_POST["pro_nombre"][$i] . "', '" . $_POST["pro_opcion"][$i] . "', '" . $_POST["pro_cantidad"][$i] . "','" . $_POST["pro_precio"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($ProContador!=0) {
		    $resultadocon = mysqli_query($connection, $sql);
			if(!empty($resultadocon)) $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
		<li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
		}
	}
	else
	{
	?>
	<br><br>
<div class="col-sm-0 col-sm-offset-0">	
	<div class="alert alert-danger text-center" role="alert">
	  <strong>Transaccion Cancelada: </strong> SERVICIO DE <?php echo $obs;  ?> KMS. no soportado.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
</div>	
	<?php	
	}
}
	
?>
<!doctype html>
<html lang="es">
<head>
	<script>
	function AgregarMas() {
		$("<div>").load("InputDinamico.php", function() {
				$("#productos").append($(this).html());
		});	
	}
	function BorrarRegistro() {
		$('div.lista-producto').each(function(index, item){
			jQuery(':checkbox', this).each(function () {
				if ($(this).is(':checked')) {
					$(item).remove();
				}
			});
		});
	}
	</script>
</head>
<body>
<header> 
</header>
<!-- Begin page content -->

<div class="container">
	<center><h4 class="modal-title" id="myModalLabel">Nueva Orden de Mantenimiento</h4></center>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
	  
<form name="frmProduct" method="post" action="">

<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate> 
<div class="load-animate animated fadeInUp">
<div class="row">
</div>
<input id="currency" type="hidden" value="$">
<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<label class="control-label"> Fecha: </label>
		<input type="date" name="fecha" id="fecha" class="form-control" required >

		<label class="control-label"> Tipo: </label>
		<select  name="tipo" id="tipo" class="form-control" required >
			<option value="">SELECCIONAR TIPO</option>
			<option value="INT">SERVICIO INTERNO</option>
			<option value="EXT">SERVICIO EXTERNO</option>			
		</select>	
				
		<label class="control-label"> Proveedor: </label>
		<select name="proveedor" id="proveedor" class="form-control" required="required" >
			<option value="" selected="selected">SELECCIONAR PROVEEDOR</option>
			<?php
			$sql = "SELECT prov_id, prov_nombre FROM proveedor ORDER BY prov_nombre ASC";
			$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));
			while( $rows = mysqli_fetch_assoc($resultset) ) { 
			?>
			<option value="<?php echo $rows["prov_id"]; ?>"><?php echo $rows["prov_nombre"]; ?></option>
			<?php }	 ?>
		</select>

		<label class="control-label"> Num Placa: </label>
		<input class="form-control" id="search" type="text" name="placa" onClick="this.select();" pattern="[0A-Z]{1}[0-9]{6}-[0-9]{4}" title="Ej.: M012345-2011" placeholder="Ej: M######-####" required="required" />
</div> 

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-center">
		<label class="control-label"> Servicio: </label>
		<select name="serv" class="form-control" required>
			<option value="REV_GRL">REVISION GENERAL</option>
			<option value="MAN_PRE">MANTENIMIENTO PREVENTIVO</option>
			<option value="MAN_COR">MANTENIMIENTO CORRECTIVO</option>
		</select>

		<label class="control-label"> Motivo Mantto: </label>
		<select name="motivo" id="motivo" class="form-control" required="required" >
			<option value="" selected="selected">SELECCIONAR SERVICIO</option>
			<?php
			$sql = "SELECT serv_id, serv_nombre FROM servicio ORDER BY serv_id ASC";
			$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));
			while( $rows = mysqli_fetch_assoc($resultset) ) { 
			?>
			<option value="<?php echo $rows["serv_id"]; ?>"><?php echo $rows["serv_nombre"]; ?></option>
			<?php }	 ?>
		</select>
		
		<label class="control-label"> Kilometraje: </label>
		<input type="number" name="kilo" min="1" id="kilo" class="form-control" onClick="this.select();" required >

	
</div>      
		
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
	
	<label class="control-label"> No. Orden / Requi: </label>
	<input type="number" name="orden" min="1" value="<?php echo $num; ?>" id="orden" class="form-control" placeholder="No Documento" onClick="this.select();" required >
		
	<label class="control-label"> Nom.Recibe: </label>
	<input type="text" name="reci" id="reci" class="form-control" onClick="this.select();" required >
		
	<label class="control-label"> Nom.Mecanico: </label>
	<input type="text" name="meca" id="meca" class="form-control" onClick="this.select();" required >

</div>
</div>
      
<br>

<div id="outer">
<div id="header">
	<div class="float-left">&nbsp; Nro.</div>
	<div class="float-left col-heading">Tipo Detalle</div>
	<div class="float-left col-heading">Opcion Req.</div>
	<div class="float-left col-heading"> Nombre Producto</div>
	<div class="float-left col-heading2"> Cantidad</div>
	<div class="float-left col-heading2"> Precio</div>
</div>
<div id="productos">
<?php require_once("InputDinamico.php") ?>
</div>
<div class="btn-action float-clear">
<input class="btn btn-success" type="button" name="agregar_registros" value="Agregar + " onClick="AgregarMas();" />
<input class="btn btn-danger" type="button" name="borrar_registros" value="Quitar - " onClick="BorrarRegistro();" />
<span class="success"><?php if(isset($resultado)) { echo $resultado; }?></span>
</div>
<div class="text-center" style="position: relative;">
<hr><input class="btn btn-primary" type="submit" name="guardar" value="Guardar Ahora"/>
</div>
</div>
</form>


      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 

  
</div>
<!-- Fin container -->
<footer class="page-header text-center">
<hr>
Desarrollado x JRCO para SAVONA 2022.
</footer>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#search").autocomplete({
			source: 'search.php',
			minLength: 0,
		});
	});
</script>
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