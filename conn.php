<?php
	$conn = new mysqli('localhost', 'root', '', 'sav_mantto_vehiculo');
	
	if(!$conn){
		die("Error: Can't connect to database");
	}
?>