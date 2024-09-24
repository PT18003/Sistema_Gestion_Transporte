<?php
	session_start();
	include_once('dbconect.php');


$ultimo=$_POST['ultimo'];
//echo "Es ".$ultimo."=";
$servicio = $_POST['servicio'];
//echo $servicio."<BR>";

if($ultimo<>$servicio){
//echo "NO... ejecutar query";
if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
			$id = $_GET['id'];
			$placa = $_POST['placa'];
			$licencia = $_POST['lic'];
			$ruta = $_POST['ruta'];
			$sucursal = $_POST['suc'];
			$kilo = $_POST['kilo'];
			$servicio = $_POST['servicio'];
			$fini=date ('Y-m-d');
			$ffin="";
			$estado="ABIERTO";

		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO rep_servicio (rep_asignacion, rep_placa, rep_licencia, rep_ruta, rep_sucursal, rep_kilo, rep_serv, rep_feini, rep_fefin, rep_estado ) 
		VALUES (:id, :placa, :licencia, :ruta, :sucursal, :kilo, :servicio, :inicio, :fin, :estado)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(
		':id' => $_GET['id'],
		':placa' => $_POST['placa'],
		':licencia' => $_POST['lic'],
		':ruta' => $_POST['ruta'],
		':sucursal' => $_POST['suc'],		
		':kilo' => $_POST['kilo'], 
		':servicio' => $_POST['servicio'], 
		':inicio' => $fini,
		':fin' => $ffin,
		':estado' => $estado
		)))
		? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();

}

else{
	$_SESSION['message'] = 'Llene el formulario';
}
}else
{
	$_SESSION['message'] = 'El Servicio '.$ultimo .' en asignacion '.$id.' Ya fue realizado';

}

header('location: repServicio.php');


?>