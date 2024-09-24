<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare(
		"INSERT INTO licencia 
		(
		lc_num,
		lc_nombres,
		lc_apellidos,
		lc_dui,
		lc_tramite,
		lc_fec_exp,
		lc_fec_nac,
		lc_fec_vto,
		lc_clase,
		lc_ojos,
		lc_altura,
		lc_tiposangre,
		lc_email,
		lc_genero,
		lc_numcontrol,
		lc_medicacion,
		lc_alergico,
		lc_emer_avisar_a,
		lc_telefono,
		lc_direccion
		) 
		VALUES 
		(
		:lic,
		:nom,
		:ape,
		:dui,
		:tram,
		:fexp,
		:fnac,
		:fven,
		:clase,
		:ojos,
		:altura,
		:tpsang,
		:email,
		:genero,
		:control,
		:med,
		:alergico,
		:avisar,
		:tel,
		:dir
		)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array
		(
		':lic'=> $_POST['lic'],
		':nom'=> $_POST['nom'],
		':ape'=> $_POST['ape'],
		':dui'=> $_POST['dui'],
		':tram'=> $_POST['trami'],
		':fexp'=> $_POST['fexpe'],
		':fnac'=> $_POST['fnaci'],
		':fven'=> $_POST['fvenc'],
		':clase'=> $_POST['clase'],
		':ojos'	=> $_POST['ojos'],
		':altura'=> $_POST['altura'],
		':tpsang'=> $_POST['tipsang'],
		':email'=> $_POST['email'],
		':genero'=> $_POST['genero'],
		':control'=> $_POST['control'],
		':med'=> $_POST['medic'],
		':alergico'=> $_POST['alergic'],
		':avisar'=> $_POST['avisa'],
		':tel'=> $_POST['tel'],
		':dir'=> $_POST['dir']
		))) ? 'Registro guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';	
	
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

header('location: motoristas.php');
	
?>