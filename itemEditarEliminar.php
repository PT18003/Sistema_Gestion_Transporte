<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $row['par_codigo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Editar Item</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="itemEditar.php?id=<?php echo $row['par_codigo']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Codigo :</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="codigo" readonly="readonly" value="<?php echo $row['par_codigo']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre Item:</label>
					</div>
					<div class="col-sm-10">
					<datalist id="listas">
					<?php
						include_once('dbconect.php');

						$database = new Connection();
						$db = $database->open();
						$query = $db->prepare("SELECT par_codigo, par_nombre FROM partes ORDER BY par_nombre ASC");
						$query->execute();
						$data = $query->fetchAll();

						foreach ($data as $valores):
						echo '<option value="'.$valores["par_nombre"].'">'.$valores["par_nombre"].'</option>';
						endforeach;
					?>		
					</datalist>
 
					<!-- Asociamos al input la datalist 'listas' -->
						<input name="item" list="listas" class="form-control" value="<?php echo $row['par_nombre']; ?>" required="required">													
					</div>
				</div>	
				<div class="row form-group">	
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Precio Item:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" name="precio" class="form-control" step="0.01" min="0" value="<?php echo $row['par_precio']; ?>" required="required">					
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
<div class="modal fade" id="delete_<?php echo $row['par_codigo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar Registro</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Esta seguro de Borrar el registro?</p>
				<h3 class="text-center"><?php echo'Codigo:'. $row['par_codigo'].'<br> '.$row['par_nombre']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="itemBorrar.php?id=<?php echo $row['par_codigo']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>