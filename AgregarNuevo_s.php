<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$id=$_POST['idServ'];
	$servicio=strtoupper($_POST['servicio']);
	$detalle=$_POST['detalle'];
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO servicio (serv_id, serv_nombre, serv_detalle) VALUES (:id, :nombre, :detalle)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':id' => $id,':nombre' => $servicio, ':detalle' => $detalle))) ? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
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

header('location: servicios.php');
	
?>