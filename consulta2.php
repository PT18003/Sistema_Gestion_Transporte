<?php
require('funcion.php');
require('menuBar.php');

if(isset($_SESSION['user'])){	
echo "Bienvenido!:<b> ".$_SESSION['user']."</b>";

$con = new mysqli("localhost","root","","sav_mantto_vehiculo"); // Conectar a la BD
$sql = "SELECT rec_id, rec_fecha, rec_placa, SUM(rec_consumo) AS Consumo 
FROM recorrido GROUP BY rec_placa"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}

$sqlc = "SELECT rec_id, rec_fecha, (rec_placa) as PCo, SUM(rec_consumo) AS ConsumoCol 
FROM recorrido R
INNER JOIN asignacion A
ON A.tc_num_placa=R.rec_placa
WHERE A.suc_id=1
GROUP BY R.rec_placa"; // Consulta SQL
$query2 = $con->query($sqlc); // Ejecutar la consulta SQL
$data2 = array(); // Array donde vamos a guardar los datos
while($c = $query2->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data2[]=$c; // Guardar los resultados en la variable $data
}

$sqls = "SELECT rec_id, rec_fecha, (rec_placa) as PSm, SUM(rec_consumo) AS ConsumoSm 
FROM recorrido R
INNER JOIN asignacion A
ON A.tc_num_placa=R.rec_placa
WHERE A.suc_id=2
GROUP BY R.rec_placa"; // Consulta SQL
$query3 = $con->query($sqls); // Ejecutar la consulta SQL
$data3 = array(); // Array donde vamos a guardar los datos
while($s = $query3->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data3[]=$s; // Guardar los resultados en la variable $data
}

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
	<h4 class="page-header text-center">Consumo Acumulado Combustible</h4>

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
            label: 'Consumo (Gals)',
            data: [
        <?php foreach($data as $d):?>
        <?php echo $d->Consumo;?>, 
        <?php endforeach; ?>
            ],
            backgroundColor: "#af58b5",
            borderColor: "#a91335",
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
    type: 'line', /* valores: line, bar*/
    data: data,
    options: options
});
</script>


<canvas id="chart2" style="width:100%;" height="50"></canvas>
<script>
		var ctx2 = document.getElementById("chart2");
		var data2 = {
				labels: [ 
				<?php foreach($data2 as $d2):?>
				"<?php echo $d2->PCo?>", 
				<?php endforeach; ?>
				],
				datasets: [{
					label: 'Consumo Colon (Gals)',
					data: [
				<?php foreach($data2 as $d2):?>
				<?php echo $d2->ConsumoCol;?>, 
				<?php endforeach; ?>
					],
					backgroundColor: "#13a972",
					borderColor: "#3375a5",
					borderWidth: 2
				}]
			};
		var options2 = {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			};
		var chart2 = new Chart(ctx2, {
			type: 'line', /* valores: line, bar*/
			data: data2,
			options: options2
		});
</script>

<canvas id="chart3" style="width:100%;" height="50"></canvas>
<script>
		var ctx3 = document.getElementById("chart3");
		var data3 = {
				labels: [ 
				<?php foreach($data3 as $d3):?>
				"<?php echo $d3->PSm?>", 
				<?php endforeach; ?>
				],
				datasets: [{
					label: 'Consumo SM (Gals)',
					data: [
				<?php foreach($data3 as $d3):?>
				<?php echo $d3->ConsumoSm;?>, 
				<?php endforeach; ?>
					],
					backgroundColor: "#12acf3",
					borderColor: "#ff7400",
					borderWidth: 2
				}]
			};
		var options3 = {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			};
		var chart3 = new Chart(ctx3, {
			type: 'line', /* valores: line, bar*/
			data: data3,
			options: options3
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
				<th scope="col"> Fecha </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Asign. </th>
				<th scope="col" class="filter-select filter-exact" data-placeholder="Filtrar"> Sucursal </th>					
				<th scope="col"> No. Placa </th>
				<th scope="col"> Consumo (Gals)</th>
			</tr>
	</thead>
	<tfoot>
			<tr>			
				<th scope="col"> Fecha </th>
				<th scope="col"> Asign. </th>
				<th scope="col"> Sucursal </th>					
				<th scope="col"> No. Placa </th>
				<th scope="col"> Consumo (Gals)</th>
			</tr>
	</tfoot>	
	<tbody>
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT *,MAX(rec_fecha) AS Fecha, SUM(rec_consumo) AS consumo 
				FROM recorrido A 
				INNER JOIN asignacion B
				ON B.tc_num_placa=A.rec_placa
				INNER JOIN sucursal C
				ON B.suc_id=C.suc_id 
				WHERE rec_consumo >0
				GROUP BY rec_placa
				ORDER BY Fecha DESC';
				foreach ($db->query($sql) as $row) {
					?>
					<tr>						
							<td> <?php echo $row['Fecha']; ?> </td>
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
							<td> <?php echo $row['consumo']; ?> </td>
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