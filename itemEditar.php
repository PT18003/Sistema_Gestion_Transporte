<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_POST['codigo'];
			$nombre = strtoupper($_POST['item']);
			$precio = $_POST['precio'];

			$sql = "UPDATE partes SET par_nombre = '$nombre', par_precio = '$precio' WHERE par_codigo = '$id'";
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

	header('location: items.php');

?>