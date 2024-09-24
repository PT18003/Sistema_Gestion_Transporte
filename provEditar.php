<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_POST['codigo'];
			$prvnom=strtoupper($_POST['prvnom']);
			$prvtel=$_POST['prvtel'];
			$prvemail=$_POST['prvemail'];
			$prvdir=$_POST['prvdir'];

			$sql = "UPDATE proveedor SET prov_nombre = '$prvnom', prov_telefono = '$prvtel', prov_mail = '$prvemail', prov_direccion = '$prvdir' WHERE prov_id = '$id'";
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

	header('location: proveedores.php');

?>