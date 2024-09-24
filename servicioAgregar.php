<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Agregar Nuevo Registro</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="AgregarNuevo_s.php">
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">ID Servicio:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" name="idServ" class="form-control" step="1" min="0" required="required">					
					</div>								
				</div>				
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre Servicio:</label>
					</div>
					<div class="col-sm-10">
					<datalist id="serv">
					<?php
						include_once('dbconect.php');

						$database = new Connection();
						$db = $database->open();
						$query = $db->prepare("SELECT serv_id, serv_nombre FROM servicio ORDER BY serv_nombre ASC");
						$query->execute();
						$data = $query->fetchAll();

						foreach ($data as $valores):
						echo '<option value="'.$valores["serv_nombre"].'">'.$valores["serv_nombre"].'</option>';
						endforeach;
					?>		
					</datalist>
 
					<!-- Asociamos al input la datalist 'listas' -->
					<input name="servicio" list="serv" class="form-control" placeholder="Nombre servicio" required="required">							
					</div>
				</div>
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Detalle Servicio:</label>
					</div>
					<div class="col-sm-10">
						<textarea name="detalle" class="form-control" rows="4" cols="50" required="required"></textarea>					
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