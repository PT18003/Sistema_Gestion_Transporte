<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['cerrar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$fecha = $_POST['fechafin'];
			$estado = $_POST['estado'];
			$mecanico = $_POST['mecanico'];
			$observ = $_POST['observaciones'];

			$sql = "UPDATE rep_servicio SET rep_fefin = '$fecha', rep_estado = '$estado', rep_nom_mec = '$mecanico', rep_observ = '$observ' WHERE rep_num = '$id'";
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

	header('location: repServicio.php');

?>