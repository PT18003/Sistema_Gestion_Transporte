<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$prvnom=strtoupper($_POST['prvnom']);
	$prvtel=$_POST['prvtel'];
	$prvemail=$_POST['prvemail'];
	$prvdir=$_POST['prvdir'];
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO proveedor (prov_nombre, prov_telefono, prov_mail, prov_direccion) VALUES (:nombre, :tel, :mail, :dir)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $prvnom, ':tel' => $prvtel, ':mail' => $prvemail, ':dir' => $prvdir ))) ? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
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

header('location: proveedores.php');
	
?>