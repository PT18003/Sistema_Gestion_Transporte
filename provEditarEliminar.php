<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $row['prov_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Editar Proveedor</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="provEditar.php?id=<?php echo $row['prov_id']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Id Prov. :</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="codigo" readonly="readonly" value="<?php echo $row['prov_id']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Proveedor:</label>
					</div>
					<div class="col-sm-10">
					<datalist id="prov">
					<?php
						include_once('dbconect.php');

						$database = new Connection();
						$db = $database->open();
						$query = $db->prepare("SELECT prov_id, prov_nombre FROM proveedor ORDER BY prov_nombre ASC");
						$query->execute();
						$data = $query->fetchAll();

						foreach ($data as $valores):
						echo '<option value="'.$valores["prov_nombre"].'">'.$valores["prov_nombre"].'</option>';
						endforeach;
					?>		
					</datalist>
 
					<!-- Asociamos al input la datalist 'listas' -->
					<input name="prvnom" list="prov" class="form-control" placeholder="Ej: Taller ABC" required="required" value="<?php echo $row['prov_nombre']; ?>">			
					
					</div>
				</div>
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Telefono:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" name="prvtel" class="form-control" pattern="[0,2,6,7]{1}[0-9]{3}-[0-9]{4}" title="Formato 2222-2222" placeholder="Ej: ####-####" value="<?php echo $row['prov_telefono']; ?>">					
					</div>								
				</div>		
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Email:</label>
					</div>
					<div class="col-sm-10">
						<input type="email" name="prvemail" class="form-control" placeholder="Ej: contacto@taller.com" value="<?php echo $row['prov_mail']; ?>">					
					</div>								
				</div>	
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Direccion:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" name="prvdir" class="form-control"  placeholder="Direccion domicilio" required="required" value="<?php echo $row['prov_direccion']; ?>">					
					</div>								
				</div>	
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['prov_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar Registro</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Esta seguro de Borrar el registro?</p>
				<h3 class="text-center"><?php echo'ID Prov.:'. $row['prov_id'].'<br> '.$row['prov_nombre']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="provBorrar.php?id=<?php echo $row['prov_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>