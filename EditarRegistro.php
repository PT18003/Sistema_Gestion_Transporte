<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		
		try{		
			$id = $_GET['id'];
			$fecha = $_POST['fecha'];
			$fechactrl = $_POST['fechactrl'];
			$estado = $_POST['estado'];
			$kilo = $_POST['kilo'];
			$comb = $_POST['comb'];
			$tipo = $_POST['tipo'];
			$placa = $_POST['placa'];
			$licencia = $_POST['licencia'];
			$ruta = $_POST['ruta'];
			$sucursal = $_POST['sucursal'];
			
	
			$sql = "UPDATE asignacion SET asn_fecha = '$fecha', asn_disposicion = '$estado', asn_kilometraje = '$kilo', asn_combustible = '$comb', tpt_codigo = '$tipo', tc_num_placa = '$placa', mot_id_conductor = '$licencia', rut_id = '$ruta',suc_id = '$sucursal' WHERE asn_id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Registro '. $placa.' actualizado correctamente' : 'No se puso actualizar registro';

			$dba = $database->open();
			$reco =
			"SELECT 
			(
			CASE
				WHEN MAX(rec_km) IS NOT NULL THEN MAX(rec_km)
				WHEN MAX(rec_km) IS NULL THEN 0
			END    
			) AS Ant
			FROM recorrido WHERE rec_placa='$placa'";
			foreach ($dba->query($reco) as $row) {
				$ant=$row['Ant'];
			}
			$ant;
			
			$dbr = $database->open();
			$stmt = $dbr->prepare("INSERT INTO recorrido (rec_fecha, rec_placa, rec_consumo, rec_km, rec_kmAnt) VALUES (:fecha,:placa,:consumo ,:recoU, :recoA)");
			//instrucción if-else en la ejecución de nuestra declaración preparada
			$_SESSION['message'] = ( $stmt->execute(array(':fecha' => $_POST['fechactrl'],':placa' => $_POST['placa'], ':consumo' => $_POST['comb'],':recoU' => $_POST['kilo'], ':recoA' => $ant)) ) ? 'Registro '. $placa.' guardado correctamente el '.$fechactrl : 'Algo salió mal. No se puede agregar miembro';	
			
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