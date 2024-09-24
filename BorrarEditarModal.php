


<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $row['asn_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Editar Asignacion</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			
			  <ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home<?php echo $row['asn_id']; ?>">Datos Generales</a></li>
				<li><a data-toggle="tab" href="#menu1<?php echo $row['asn_id']; ?>">Act. Combustible</a></li>
		<!--	<li><a data-toggle="tab" href="#menu2">Menu 2</a></li>	-->
		<!--	<li><a data-toggle="tab" href="#menu3">Menu 3</a></li>  -->
			  </ul>
			<br>
			  <div class="tab-content">
				<div id="home<?php echo $row['asn_id']; ?>" class="tab-pane fade in active">
					<form method="POST" action="EditarRegistro.php?id=<?php echo $row['asn_id']; ?>">
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Num Placa:</label>
						</div>
						<div class="col-sm-10">
							<select id="placa" class="form-control" name="placa" required="required">
							  <option value="<?php echo $row['tc_num_placa']; ?>"> <?php echo $row['tc_num_placa']; ?> </option>
							  <option value="0000000-0000">0000000-0000</option>
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
							<label class="control-label" style="position:relative; top:7px;">Fecha Asign:</label>
						</div>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="fecha" value="<?php echo $row['asn_fecha']; ?>">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Fecha Ctrl:</label>
						</div>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="fechactrl" value="" required="required">
						</div>
					</div>		
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Kilometraje:</label>
						</div>
						<div class="col-sm-10">
							<input type="number" class="form-control" min="0" name="kilo" value="<?php echo $row['asn_kilometraje']; ?>" required="required" onClick="this.select();">
						</div>
					</div>		
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Combustible:</label>
						</div>
						<div class="col-sm-10">
							<input type="number" class="form-control" min="0.000" step="0.001" name="comb" value="<?php echo $row['asn_combustible']; ?>" required="required" onClick="this.select();">
						</div>
					</div>						
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Estado:</label>
						</div>
						<div class="col-sm-10">
							<select id="estado" class="form-control" name="estado" required="required">
							  <option value="<?php echo $row['asn_disposicion']; ?>"><?php echo $row['asn_disposicion']; ?></option>
							  <option value="ASIGNADO">ASIGNADO</option>
							  <option value="ACCIDENTADO">ACCIDENTADO</option>	  
							  <option value="AVERIADO">AVERIADO</option>
							  <option value="BACKUP">BACKUP</option>
							  <option value="EN TALLER">EN TALLER</option>
							</select>					</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Tipo:</label>
						</div>
						<div class="col-sm-10">
							<select id="tipo" class="form-control" name="tipo" required="required">
							  <option value="<?php echo $row['tpt_codigo']; ?>"> <?php echo $row['tpt_nombtre']; ?> </option>
								<?php
									
									$query = $db->prepare("SELECT * FROM tipo_transporte");
									$query->execute();
									$data = $query->fetchAll();

									foreach ($data as $valores):
									echo '<option value="'.$valores["tpt_codigo"].'">'.$valores["tpt_nombtre"].'</option>';
									endforeach;
								?>
							</select>	
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Num Lic:</label>
						</div>
						<div class="col-sm-10">
							<select id="licencia" class="form-control" name="licencia" required="required">
							  <option value="<?php echo $row['mot_id_conductor']; ?>"> <?php echo $row['mot_id_conductor']; ?> </option>
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
							<select id="ruta" class="form-control" name="ruta" required="required">
							  <option value="<?php echo $row['rut_id']; ?>"> <?php echo $row['rut_nombre']; ?> </option>
								<?php
									
									$query = $db->prepare("SELECT * FROM ruta");
									$query->execute();
									$data = $query->fetchAll();

									foreach ($data as $valores):
									echo '<option value="'.$valores["rut_id"].'">'.$valores["rut_nombre"].'</option>';
									endforeach;
								?>
							</select>					
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Sucursal:</label>
						</div>
						<div class="col-sm-10">
							<select id="sucursal" class="form-control" name="sucursal" required="required">
							  <option value="<?php echo $row['suc_id']; ?>"> <?php echo $row['suc_nombre']; ?> </option>
								<?php
									
									$query = $db->prepare("SELECT * FROM sucursal");
									$query->execute();
									$data = $query->fetchAll();

									foreach ($data as $valores):
									echo '<option value="'.$valores["suc_id"].'">'.$valores["suc_nombre"].'</option>';
									endforeach;
								?>
							</select>						
						</div>
					</div>		
					<div class="row form-group">
						<div class="col-sm-1">
							<button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</button>
						</div>
					</div>	
					</form>
				</div>
				<div id="menu1<?php echo $row['asn_id']; ?>" class="tab-pane fade">	
					<form method="POST" action="EditarCombustible.php?id=<?php echo $row['asn_id']; ?>">
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Placa:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="placa" value="<?php echo $row['tc_num_placa']; ?>" readonly="readonly">
						</div>
					</div>							
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Fecha Ctrl:</label>
						</div>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="fechaCon" value="" required="required">
						</div>
					</div>						
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Consumo:</label>
						</div>
						<div class="col-sm-10">
							<input type="number" class="form-control" min="0.000" step="0.001" name="consumo" value="" placeholder="0.000" required="required">
						</div>
					</div>						
					<div class="row form-group">
						<div class="col-sm-1">
							<button type="submit" name="editarCom" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</button>
						</div>
					</div>	
					</form>
				</div>
				<!--
				<div id="menu2" class="tab-pane fade">
				  <h3>Menu 2</h3>
				  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
				</div>
				<div id="menu3" class="tab-pane fade">
				  <h3>Menu 3</h3>
				  <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
				</div>
				-->
			  </div>			
            </div> 
			</div>
            <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>				
            </div>

        </div>
    </div>
</div>

<!-- Ventana info 
<div class="modal fade" id="infor_<?php //echo $row['asn_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Informacion</h4></center>
            </div>
			<?php 
			/*
			$lic=$row['mot_id_conductor'];
			$tc=$row['tc_num_placa'];
			$rut=$row['rut_id'];
			$suc=$row['suc_id'];
			
					//incluimos el fichero de conexion
					include_once('dbconect.php');

					//crear conexion 1
					$database = new Connection();
					$db = $database->open();
					

					$sqlm = "SELECT lc_num, lc_nombres, lc_apellidos FROM licencia WHERE lc_num='$lic'";
					foreach ($db->query($sqlm) as $row) {		
					
					$lc=$row['lc_num'];
					$nombre=$row['lc_nombres'];
					$apellido=$row['lc_apellidos'];		
					
					}			
			?>
			
            <div class="modal-body">	
            	<p class="text-center">Motorista:</p>
				<p class="text-center"><?php echo $lc; ?></p>
				<p class="text-center"><?php echo $nombre." ".$apellido; ?></p>
			<?php
					$sqlv = "SELECT tc_anio_vehiculo, tc_marca, tc_modelo, tc_clase FROM tar_circulacion WHERE tc_numplaca='$tc'";
					foreach ($db->query($sqlv) as $row) {		
					
					$year=$row['tc_anio_vehiculo'];
					$marca=$row['tc_marca'];
					$modelo=$row['tc_modelo'];
					$clase=$row['tc_clase'];					
					
					}				
			?>
            	<p class="text-center">Tipo:</p>
				<p class="text-center"><?php echo $clase." / ".$tc; ?></p>
				<p class="text-center"><?php echo $marca." ".$modelo." ".$year; ?></p>
			<?php
					$sqlr = "SELECT rut_id, rut_nombre FROM ruta WHERE rut_id='$rut'";
					foreach ($db->query($sqlr) as $row) {		
					
					$ruta=$row['rut_nombre'];
									
					}				
			?>	
            	<p class="text-center">Ruta: <?php echo $ruta; ?></p>
			<?php
					$sqlr = "SELECT suc_id, suc_nombre FROM sucursal WHERE suc_id='$suc'";
					foreach ($db->query($sqlr) as $row) {		
					
					$nsuc=$row['suc_nombre'];
									
					}	
			*/					
			?>	
            	<p class="text-center">Sucursal: <?php //echo $nsuc; ?></p>

			
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
            </div>
        </div>
    </div>
</div>
-->

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['asn_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar Registro</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Esta seguro de Borrar el registro?</p>
				<h3 class="text-center"><?php echo'Ruta:'. $row['rut_id'].' - Sucursal: '.$row['suc_id'].'<br> Placa:'.$row['tc_num_placa'].'<br>Conductor: '.$row['mot_id_conductor']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="BorrarRegistro.php?id=<?php echo $row['asn_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>
