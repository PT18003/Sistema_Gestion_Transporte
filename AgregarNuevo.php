<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO asignacion (asn_fecha, asn_disposicion, asn_kilometraje, asn_combustible, tpt_codigo, tc_num_placa, mot_id_conductor, rut_id, suc_id) VALUES (:fecha, :estado, :kilo, :comb, :tipo, :placa, :licencia, :ruta, :sucursal)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':fecha' => $_POST['fecha'],':estado' => $_POST['estado'] , ':kilo' => $_POST['kilo'], ':comb' => $_POST['comb'], ':tipo' => $_POST['tipo'], ':placa' => $_POST['placa'], ':licencia' => $_POST['licencia'], ':ruta' => $_POST['ruta'], ':sucursal' => $_POST['sucursal'])) ) ? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
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

header('location: asignacion.php');
	
?>