<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_POST['idServ'];
			$servicio = strtoupper($_POST['servicio']);
			$detalle = $_POST['detalle'];

			$sql = "UPDATE servicio SET serv_nombre = '$servicio', serv_detalle = '$detalle' WHERE serv_id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'registro actualizado correctamente' : 'No se puso actualizar registro';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

	header('location: servicios.php');

?>