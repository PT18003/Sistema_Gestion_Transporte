
<!-- Ventana Revisar -->
<div class="modal fade" id="ver_<?php echo $row['asn_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Detalle Prox. Servicio</h4></center>
            </div>
            <div class="modal-body">
				<div class="container-fluid">
									
					<?php
					$id_asn=$row['asn_id'];
					$placa=$row['tc_num_placa'];
					
					//incluimos el fichero de conexion
					include_once('dbconect.php');

					//crear conexion 1
					$database = new Connection();
					$db = $database->open();
					try{	
					
					$sql = "SELECT * FROM servicio WHERE serv_id=
					(SELECT MAX(mantto_prox) FROM asignacion WHERE asn_id='$id_asn') limit 1";
					
					foreach ($db->query($sql) as $row) {		
					
					$servicio=$row['serv_id'];
					$detalle=$row['serv_detalle'];		
					
					}
					
				}
				catch(PDOException $e){
					echo "Hubo un problema en la conexión: " . $e->getMessage();
				}

				//Cerrar la Conexion 1
				$database->close();
				
				?>
				<form method="POST" >
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">ID:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="id_asn" value="<?php echo $id_asn." - ".$placa; ?>" readonly>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Servicio:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="servicio" value="<?php echo "SERVICIO DE ". $servicio ." KMS"; ?>" readonly>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-sm-2">
							<label class="control-label" style="position:relative; top:7px;">Detalle:</label>
						</div>
						<div class="col-sm-10">
							<textarea class="form-control" rows="6" cols="20" name="detalle" readonly ><?php echo $detalle; ?></textarea>
						</div>
					</div>
                <hr><center><h5 class="modal-title" id="myModalLabel">Ultimos Servicios Realizados</h5></center>				
					
				<?php
				//crear conexion 3
				$database2 = new Connection();
				$db2 = $database2->open();
				$i=-4;
				try{	
						$sql2 = "SELECT * FROM orden_rep WHERE ord_placa='$placa' ORDER BY ord_obsv DESC LIMIT 3";
						foreach ($db2->query($sql2) as $row) {	
													
						$row['ord_num'];
						$row['ord_fecha']; 
						$row['ord_placa']; 
						$row['ord_km'];
						$row['ord_serv'];
						$row['ord_mecanico'];
						$row['ord_recibe'];
						$row['ord_obsv'];
						$i++;		
				?>		
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Serv. <?php echo -$i; ?>:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ultimo" value="<?php echo "SERVICIO DE ".$row['ord_obsv']." KMS"; ?>" readonly>
					</div>
				</div>
						
				<?php
	
						}
						
					}
					catch(PDOException $e){
						echo "Hubo un problema en la conexión: " . $e->getMessage();
					}

					//Cerrar la Conexion
					$database2->close();						
				?>					
					
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
				</form>
				</div>	
			</div> 			
        </div>
    </div>
</div>
