<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$item=strtoupper($_POST['item']);
	$precio=$_POST['precio'];
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO partes (par_nombre, par_precio) VALUES (:nombre, :precio)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $item, ':precio' => $precio))) ? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
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

header('location: items.php');
	
?>