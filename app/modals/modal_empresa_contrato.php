<div class="modal fade" id="contratoEmpresa<?=$row['id']?>" role="dialog">
  <form  method="post" action="../app/vistaEmpresaA.php">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Actualización de contrato del comprador</h4>
        </div>
        <div class="modal-body">
          <p>                                                      
          <input name="id" type="hidden" value="<?=$row['id']?>" />
          <input name="razon_social" type="text" class="form-control" value="<?="Nombre= " . $row['razon_social']?>" disabled />
          <input name="numero_rif" type="text" class="form-control" value="<?="Rif= ".$row['numero_rif']?>" disabled />
          Numero de Contrato:
          <input name="contrato" type="text" class="form-control" value="<?php echo $row['contrato']; ?>" />
          <span style="color:red;"><?php echo "Ultima fecha de contrato: " . $row['fecha_contrato']; ?></span>
          <input type="date" id="fecha_contrato" name="fecha_contrato" class="form-control" min=""<?php echo $row['fecha_contrato']; ?>"" value="<?php echo date("Y-m-d"); ?>">
          </p>
          Tipo de Plan: <?php  echo $row['plan'];?>
          <select id="plan" name="plan" class="form-control">
          	<option value="B"
            <?php
			if( $row['plan'] == "B"){
				echo "selected";	
			}
			?>
            >Basico</option>
            
            <option value="A"
            <?php
			if( $row['plan'] == "A"){
				echo "selected";	
			}
			?>
            >Avanzado</option>
            
            <option value="C"   
            <?php
			if( $row['plan'] == "C"){
				echo "selected";	
			}
			?>>Avanzado / CIEC</option>
          </select>
        </div>
        <div class="modal-footer">
          <button name="modal_contrato_empresa" value="actualizar" type="submit" class="btn btn-success">Si, actualizar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>      
    </div>
  </form>
</div>