<?php
require_once('conexion.php'); 
?>

<div class="lista-producto float-clear" style="clear:both;">
	 <ul class="list-group">
	   <li class="list-group-item">
			<div class="float-left"><input type="checkbox" name="item_index[]" /></div>
			<div class="float-left">				
				<select name="pro_detalle[]" class="form-control" required="required">
					<option value="REQ">REQUISICION</option>				
					<option value="REU">REPUESTOS UTILIZADOS</option>
				</select>
			</div>	
			<div class="float-left">				
				<select name="pro_opcion[]" class="form-control" required="required">
					<option value="CAMBIO">CAMBIO</option>
					<option value="CALIBRACION">CALIBRACION</option>
					<option value="ENGRASE">ENGRASE</option>
					<option value="INSUMO">INSUMO</option>
					<option value="LIMPIEZA">LIMPIEZA</option>
					<option value="LUBRICACION">LUBRICACION</option>
					<option value="REGULACION">REGULACION</option>
					<option value="REVISION">REVISION</option>
					<option value="REPUESTO">REPUESTO</option>
					<option value="PENDIENTE">PENDIENTE</option>
				</select>		
			</div>				
			<div class="float-left">
				<select name="pro_nombre[]" class="form-control" required="required" >
					<option value="" selected="selected">SELECCIONAR ITEM</option>
					<?php
					$sql = "SELECT par_codigo, par_nombre FROM partes ORDER BY par_nombre ASC";
					$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));
					while( $rows = mysqli_fetch_assoc($resultset) ) { 
					?>
					<option value="<?php echo $rows["par_nombre"]; ?>"><?php echo $rows["par_nombre"]; ?></option>
					<?php }	?>
				</select>
			</div>
			<div class="float-left"><input class="form-control" type="number" value="1" min="1" name="pro_cantidad[]" style="width:110px;" onClick="this.select();"/></div>
			<div class="float-left"><input class="form-control" type="number" value="0" min="0" step="0.01" name="pro_precio[]" style="width:110px;" onClick="this.select();"/></div>
		</li>
	 </ul> 
</div>