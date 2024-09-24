<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editarCom'])){
		$database = new Connection();
		$db = $database->open();
		
		try{		
			$id = $_GET['id'];
			$fecha = $_POST['fechaCon'];
			$comb = $_POST['consumo'];
			$placa = $_POST['placa'];
			
	
			$sql = "UPDATE asignacion SET asn_combustible = '$comb' WHERE asn_id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'registro actualizado correctamente' : 'No se puso actualizar registro';

			$sql2 = "UPDATE recorrido SET rec_consumo = '$comb' WHERE rec_fecha = '$fecha' and rec_placa = '$placa'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql2) ) ? 'registro actualizado correctamente' : 'No se puso actualizar registro';

			
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

	header('location: asignacion.php');

?>