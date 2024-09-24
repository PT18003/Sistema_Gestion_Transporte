<?php
//connect to mysql database
$connection = mysqli_connect("localhost","root","","sav_mantto_vehiculo") or die("Error " . mysqli_error($connection));

//fetch data from database

$sqlm = "select lc_num from licencia";
$resultm = mysqli_query($connection, $sqlm) or die("Error " . mysqli_error($connection));

$sqlr = "select * from ruta";
$resultr = mysqli_query($connection, $sqlr) or die("Error " . mysqli_error($connection));

$sqls = "select * from sucursal";
$results = mysqli_query($connection, $sqls) or die("Error " . mysqli_error($connection));

$sqlt = "select * from tipo_transporte";
$resultt = mysqli_query($connection, $sqlt) or die("Error " . mysqli_error($connection));

$sqla = "select * from asignacion";
$resulta = mysqli_query($connection, $sqla) or die("Error " . mysqli_error($connection));

$sqlv = "select tc_numplaca from tar_circulacion";
$resultv = mysqli_query($connection, $sqlv) or die("Error " . mysqli_error($connection));

?>