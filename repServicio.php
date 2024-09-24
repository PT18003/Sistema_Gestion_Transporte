<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SISTEMA DE MANTENIMIENTO</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="/demo/x/">NVA ORDEN</a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./index.php">ASIGNACION <span class="sr-only">(current)</span></a></li>
		<li ><a href="./vehiculos.php">VEHICULOS <span class="sr-only">(current)</span></a></li>
		<li ><a href="./motoristas.php">MOTORISTAS <span class="sr-only">(current)</span></a></li>
		<li ><a href="./repServicio.php">REP.SERVICIOS <span class="sr-only">(current)</span></a></li>
		<li ><a href="./ordenes.php">ORDENES <span class="sr-only">(current)</span></a></li>      
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
	<h1 class="page-header text-center">Vehiculos a Revisar Mantenimiento</h1>
	<div class="row">
		<div class="col-sm-12 col-sm-offset-0">

<?php 
	session_start();
	if(isset($_SESSION['message'])){
		?>
		<div class="alert alert-info text-center" style="margin-top:20px;">
			<?php echo $_SESSION['message']; ?>
		</div>
		<?php

		unset($_SESSION['message']);
	}
?>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover table-dark" style="margin-top:20px;">
	<thead>
		<th scope="col">NUM	</th>
		<th scope="col">ID_ASN </th>
		<th scope="col">NUMERO_PLACA </th>
		<th scope="col">NUMERO_LICENCIA	</th>
		<th scope="col">RUTA </th>
		<th scope="col">SUC	</th>
		<th scope="col">KILO_MTS </th>
		<th scope="col">SERVICIO </th>
		<th scope="col">FECHA_INICIO </th>
		<th scope="col">FECHA_FIN </th>
		<th scope="col">ESTADO </th>
		<th scope="col">MECANICO/PERSONAL </th>
		<th scope="col">OBSERVACIONES </th>
		<th scope="col">CERRAR_ORD </th>
	</thead>
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = "SELECT * FROM rep_servicio";
				foreach ($db->query($sql) as $row) {
					?>
					<tr>
						<td> <?php echo $row['rep_num']; ?> </td>
						<td> <?php echo $row['rep_asignacion']; ?> </td>
						<td> <?php echo $row['rep_placa']; ?> </td>
						<td> <?php echo $row['rep_licencia']; ?> </td>
						<td> <?php echo $row['rep_ruta']; ?> </td>
						<td> <?php echo $row['rep_sucursal']; ?> </td>
						<td> <?php echo $row['rep_kilo']; ?> </td>
						<td> <?php echo $row['rep_serv']; ?> </td>
						<td> <?php echo $row['rep_feini']; ?> </td>
						<td> <?php echo $row['rep_fefin']; ?> </td>
						<td> <?php echo $row['rep_estado']; ?> </td>
						<td> <?php echo $row['rep_nom_mec']; ?> </td>
						<td> <?php echo $row['rep_observ']; ?> </td>
					<td>
							<a href="#editsrv_<?php echo $row['rep_num']; ?>" class="btn btn-primary btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-ok-sign"></span> Cerrar</a>
						</td>
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
<?php include('AgregarModal.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<footer class="page-header text-center">
<hr>
Desarrollado x JRCO para SAVONA 2022.
</footer>
</body>
</html>