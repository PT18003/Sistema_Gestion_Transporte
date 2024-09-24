<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SISTEMA DE MANTENIMIENTO</title>

	<!-- grafica -->
    <script src="js/chart.min.js"></script>

	<!-- Table sorter -->
	<link type="text/css" rel="stylesheet" href="bootstrap/css/style.css"/>
	<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>


	<!-- estilos bootrap 3 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/jquery-ui.css"/>

	<!-- componentes table data -->
	<script>
		$(document).ready(function () {
		    var table = $('#example').DataTable({
				stateSave: true,
			});	
		 
		    $('#example tbody').on('click', 'tr', function () {
		        if ($(this).hasClass('selected')) {
		            $(this).removeClass('selected');
		        } else {
		            table.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }
		    });
		});		
	</script>
</head>
</html>