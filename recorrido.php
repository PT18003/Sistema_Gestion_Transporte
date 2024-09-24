<?php
require('funcion.php');
require('menuBar.php');

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";


$con = new mysqli("localhost","root","","sav_mantto_vehiculo"); // Conectar a la BD
$sql = "SELECT rec_id, rec_fecha, rec_placa, MAX(rec_km) AS KM 
FROM recorrido GROUP BY rec_placa"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<h4 class="page-header text-center">Detalle de Recorridos</h4>

<canvas id="chart1" style="width:100%;" height="100"></canvas>
<script>
var ctx = document.getElementById("chart1");
var data = {
        labels: [ 
        <?php foreach($data as $d):?>
        "<?php echo $d->rec_placa?>", 
        <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Kilometraje (Kms)',
            data: [
        <?php foreach($data as $d):?>
        <?php echo $d->KM;?>, 
        <?php endforeach; ?>
            ],
            backgroundColor: "#3898db",
            borderColor: "#9b59b6",
            borderWidth: 2
        }]
    };
var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    };
var chart1 = new Chart(ctx, {
    type: 'bar', /* valores: line, bar*/
    data: data,
    options: options
});
</script>
<hr>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
		
<?php 

	if(isset($_SESSION['message'])){
		?>
		<div class="alert alert-info text-center" style="margin-top:20px;">
			<?php echo $_SESSION['message']; ?>
		</div>
		<?php

		unset($_SESSION['message']);
	}
?>

<div>
<table id="example" class="table table-bordered table-hover" style="margin-top:20px;">
	<thead>
			<tr>
				<th scope="col"> # </th>
				<th scope="col"> Fecha </th>			
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Asign. </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Sucursal </th>					
				<th scope="col"> No. Placa </th>
				<th scope="col"> Consumo </th>
				<th scope="col"> Kms Rec. </th>
				<th scope="col"> Kms Ant. </th>
				<th scope="col"> Recorrido</th>
			</tr>
	</thead>
	<tfoot>
			<tr>
				<th scope="col"> # </th>
				<th scope="col"> Fecha </th>			
				<th scope="col"> Asign. </th>
				<th scope="col"> Sucursal </th>					
				<th scope="col"> No. Placa </th>
				<th scope="col"> Consumo </th>
				<th scope="col"> Kms Rec. </th>
				<th scope="col"> Kms Ant. </th>
				<th scope="col"> Recorrido</th>
			</tr>	
	</tfoot>	
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT *,(A.rec_km-A.rec_kmAnt) AS Rec 
				FROM recorrido A 
				INNER JOIN asignacion B
				ON B.tc_num_placa=A.rec_placa
				INNER JOIN sucursal C
				ON B.suc_id=C.suc_id 				
				ORDER BY rec_fecha ASC';
				foreach ($db->query($sql) as $row) {
					?>
					<tr>
							<td> <?php echo $row['rec_id']; ?> </td>
							<td> <?php echo $row['rec_fecha']; ?> </td>							
							<td> <?php echo $row['asn_id']; ?> </td>
							<td> <?php echo $row['suc_nombre']; ?> </td>
							<?php
							if($row['asn_id'] <=5) {
							  echo '<td style="background-color:#e0e0e0">' . $row['rec_placa'] . '</td>';
							}
							if($row['asn_id'] >=6 and $row['asn_id']<=10) {
							  echo '<td style="background-color:#ffc7c7">' . $row['rec_placa'] . '</td>';
							}
							if($row['asn_id'] >=11 and $row['asn_id']<=15) {
							  echo '<td style="background-color:#ffcfa2">' . $row['rec_placa'] . '</td>';
							}
							if($row['asn_id'] >=16 and $row['asn_id']<=20) {
							  echo '<td style="background-color:#f2ff70">' . $row['rec_placa'] . '</td>';
							}	
							if($row['asn_id'] >=21 and $row['asn_id']<=25) {
							  echo '<td style="background-color:#cdffa0">' . $row['rec_placa'] . '</td>';
							}		
							if($row['asn_id'] >=26 and $row['asn_id']<=30) {
							  echo '<td style="background-color:#a0ffbf">' . $row['rec_placa'] . '</td>';
							}
							if($row['asn_id'] >=31 and $row['asn_id']<=35) {
							  echo '<td style="background-color:#d2cfff">' . $row['rec_placa'] . '</td>';
							}	
							if($row['asn_id'] >=36 and $row['asn_id']<=40) {
							  echo '<td style="background-color:#f6cfff">' . $row['rec_placa'] . '</td>';
							}	
							if($row['asn_id'] >=41 and $row['asn_id']<=50) {
							  echo '<td style="background-color:#ffcbd8">' . $row['rec_placa'] . '</td>';
							}								
							?>
							</td>
							<td> <?php echo $row['rec_consumo']; ?> </td>
							<td> <?php echo $row['rec_km']; ?> </td>
							<td> <?php echo $row['rec_kmAnt']; ?> </td>
							<td> <?php echo $row['Rec']; ?> </td>
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