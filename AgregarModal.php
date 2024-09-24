<!DOCTYPE html>
<html>
<head>
</head>
<!-- Agregar 
Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Agregar Nuevo Registro</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="AgregarNuevo.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha Asign:</label>
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="fecha" required="required">
					</div>
				</div>			
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Estado:</label>
					</div>
					<div class="col-sm-10">
						<select id="estado" class="form-control" name="estado" required="required">
						  <option value="ASIGNADO">ASIGNADO</option>
						  <option value="ACCIDENTADO">ACCIDENTADO</option>
						  <option value="AVERIADO">AVERIADO</option>
						  <option value="BACKUP">BACKUP</option>
						  <option value="EN TALLER">EN TALLER</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Kilometraje:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="kilo" min ="0" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Combustible:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="comb" min ="0.00" step="0.01" required="required">
					</div>
				</div>				
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tipo:</label>
					</div>
					<div class="col-sm-10">
						<select id="tipo" class="form-control" name="tipo" required="required">
						  <option value="1">MOTOCICLETA</option>
						  <option value="2">CAMION</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num Placa:</label>
					</div>
					<div class="col-sm-10">
						<select id="placa" class="form-control" name="placa" required="required">
							<?php
								
								$query = $db->prepare("SELECT tc_numplaca FROM tar_circulacion WHERE tc_numplaca NOT IN(SELECT tc_num_placa FROM asignacion) ORDER BY tc_numplaca ASC");
								$query->execute();
								$data = $query->fetchAll();

								foreach ($data as $valores):
								echo '<option value="'.$valores["tc_numplaca"].'">'.$valores["tc_numplaca"].'</option>';
								endforeach;
							?>
						</select>				
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num Licencia:</label>
					</div>
					<div class="col-sm-10">
						<select id="licencia" class="form-control" name="licencia" required="required">
						  <option value="0000-000000-000-0">0000-000000-000-0</option>
							<?php
								
								$query = $db->prepare("SELECT * FROM licencia WHERE lc_num NOT IN (SELECT mot_id_conductor FROM asignacion) ORDER BY lc_num ASC");
								$query->execute();
								$data = $query->fetchAll();

								foreach ($data as $valores):
								echo '<option value="'.$valores["lc_num"].'">'.$valores["lc_num"].'</option>';
								endforeach;
							?>
						</select>					
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Ruta:</label>
					</div>
					<div class="col-sm-10">
						<?php include "conexion.php"; ?>
						<select class="form-control" name="ruta" required="required">
							<?php while($row = mysqli_fetch_array($resultr)) { ?>
									<option value="<?php echo $row['rut_id']; ?>"><?php echo $row['rut_nombre']; ?></option>
							<?php } ?>
						<?php mysqli_close($connection); ?>		
						</select>	
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Sucursal:</label>
					</div>
					<div class="col-sm-10">
						<?php include "conexion.php"; ?>
						<select class="form-control" name="sucursal" required="required">
							<?php while($row = mysqli_fetch_array($results)) { ?>
									<option value="<?php echo $row['suc_id']; ?>"><?php echo $row['suc_nombre']; ?></option>
							<?php } ?>
						<?php mysqli_close($connection); ?>		
						</select>	
					</div>
				</div>				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" name="agregar" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro</button>
			</form>
            </div>

        </div>
    </div>
</div>
</html>
