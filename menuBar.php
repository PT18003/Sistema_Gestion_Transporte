<!DOCTYPE html>
<html>
<body>
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="mantenimiento.php">NVA ORDEN</a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<li ><a href="./ordenes.php">ORDENES <span class="sr-only">(current)</span></a></li>      
        <li ><a href="./asignacion.php">ASIGNACION <span class="sr-only">(current)</span></a></li>
		<li ><a href="./recorrido.php">RECORRIDO <span class="sr-only">(current)</span></a></li>      
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">DAT. MAESTROS
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li ><a href="./motoristas.php">MOTORISTAS <span class="sr-only">(current)</span></a></li>
				<li ><a href="./vehiculos.php">VEHICULOS <span class="sr-only">(current)</span></a></li>				
				<li ><a href="./items.php">INSUMOS <span class="sr-only">(current)</span></a></li>      				
				<li ><a href="./proveedores.php">PROVEEDORES <span class="sr-only">(current)</span></a></li>
				<li ><a href="./servicios.php">SERVICIOS <span class="sr-only">(current)</span></a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">REPORTES
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li ><a href="./consulta.php">MANTTOS REALIZADOS<span class="sr-only">(current)</span></a></li>
				<li ><a href="./consulta3.php">ESTADO DE MANTTOS<span class="sr-only">(current)</span></a></li>				
				<li ><a href="./consulta1.php">LIC. X VENCER<span class="sr-only">(current)</span></a></li>      				
				<li ><a href="./consulta2.php">CONSUMO ACUMULADO <span class="sr-only">(current)</span></a></li>
			</ul>
		</li>			
	  </ul>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<a href="./CerrarSesion.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Session<span class="sr-only">(current)</a>
		</li>
	</ul>		  
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
</body>
</html>