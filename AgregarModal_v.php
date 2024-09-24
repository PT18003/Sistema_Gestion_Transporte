<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew_v" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Agregar Nuevo Registro Vehiculo</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="AgregarNuevo_v.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Placa:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="placa" pattern="[0A-Z]{1}[0-9]{6}-[0-9]{4}" title="Formato M012345-2011" placeholder="Ej: M######-####" required="required">
					</div>
				</div>			
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Propietario:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="propietario" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">NIT:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nit" pattern="[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}" title="Formato 0123-012345-012-0" placeholder="Ej: ####-######-###-#" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Depto:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="departamento" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Municipio:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="municipio" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha vencimiento:</label>
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="fven" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Fecha emision:</label> 
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="femi" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Año vehiculo:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" min="1980" name="anio" required="required">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Marca:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="marca" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Modelo:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="modelo" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Capacidad:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="capacidad" min="1" value="1" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tipo:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tipo" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Clase:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="clase" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Dominio:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="dominio" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">En calidad:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="encalidad" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Color:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="color" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num. Chasis:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="chasis" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num. Motor:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="motor" required="required">
					</div>
				</div>	
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Num. Vin:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="vin" required="required">
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