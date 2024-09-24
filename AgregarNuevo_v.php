<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare(
		"INSERT INTO tar_circulacion 
		(
		tc_numplaca,
		tc_propietario,
		tc_nit,
		tc_departamento,
		tc_municipio,
		tc_fec_veto,
		tc_fec_emi,
		tc_anio_vehiculo,
		tc_marca,
		tc_modelo,
		tc_capacidad,
		tc_tipo,
		tc_clase,
		tc_dominio,
		tc_encalidad,
		tc_color,
		tc_num_chasis,
		tc_num_motor,
		tc_num_vin
		) 
		VALUES 
		(
		:placa,
		:propiedad,
		:nit,
		:dep,
		:muni,
		:fvenc,
		:femis,
		:anio,
		:marca,
		:modelo,
		:capaci,
		:tipo,
		:clase,
		:domin,
		:encali,
		:color,
		:chasis,
		:motor,
		:vin
		)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array
		(
		':placa' => $_POST['placa'],
		':propiedad' => $_POST['propietario'],
		':nit' => $_POST['nit'],
		':dep' => $_POST['departamento'],
		':muni' => $_POST['municipio'],
		':fvenc' => $_POST['fven'],
		':femis' => $_POST['femi'],
		':anio' => $_POST['anio'],
		':marca' => $_POST['marca'],
		':modelo' => $_POST['modelo'],
		':capaci' => $_POST['capacidad'],
		':tipo' => $_POST['tipo'],
		':clase' => $_POST['clase'],
		':domin' => $_POST['dominio'],
		':encali' => $_POST['encalidad'],
		':color' => $_POST['color'],
		':chasis' => $_POST['chasis'],
		':motor' => $_POST['motor'],
		':vin' => $_POST['vin']
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

header('location: vehiculos.php');
	
?>