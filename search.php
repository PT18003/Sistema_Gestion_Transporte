<?php
	require_once 'conn.php';
	
	$search = $_GET['term'];
	
	$query = $conn->query("SELECT tc_num_placa FROM `asignacion` WHERE  `tc_num_placa` LIKE '%$search%' ORDER BY `tc_num_placa` DESC") or die(mysqli_connect_errno());
	
	$list = array();
	$rows = $query->num_rows;
	
	if($rows > 0){
		while($fetch = $query->fetch_assoc()){
			$data['value'] = $fetch['tc_num_placa']; 
			array_push($list, $data);
		}
	}
	
	echo json_encode($list);
?>