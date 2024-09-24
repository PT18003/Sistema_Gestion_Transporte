<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Agregar Nuevo Registro Motorista</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="AgregarNuevo_m.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Licencia:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="lic" pattern="[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}" title="Formato 0123-012345-012-0" placeholder="Ej: ####-######-###-#" required="required">
					</div>
				</div>			
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombres:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nom" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Apellidos:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ape" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">DUI:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="dui" pattern="[0-9]{8}-[0-9]{1}" title="Formato 01234567-0" placeholder="Ej: ########-#" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tramite:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="trami" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha Expedicion:</label>
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="fexpe" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha Nacimiento:</label> 
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="fnaci" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha Vencimiento:</label>
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="fvenc" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">clase:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="clase" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Color Ojos:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ojos" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Altura:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="altura" step="0.01" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tipo Sangre:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tipsang" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Email:</label>
					</div>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" >
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Genero:</label>
					</div>
					<div class="col-sm-10">
						<select class="form-control" name="genero" required="required">
							<option value="M"> MASCULINO </option>
							<option value="F"> FEMENINO </option>
						</select>
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num Control:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="control" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Medicacion:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="medic">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Alergico:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="alergic">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Avisar a:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="avisa" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Telefono:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tel" pattern="[0,2,6,7]{1}[0-9]{3}-[0-9]{4}" title="Formato 2222-2222" placeholder="Ej: ####-####" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Direccion:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="dir" required="required">
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