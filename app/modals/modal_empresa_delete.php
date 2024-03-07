<div class="modal fade" id="deleteChildrensn<?=$row['id']?>" role="dialog">
  <form  method="post" action="../app/vistaEmpresaA.php">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Esta seguro de eliminar esta empresa?</h4>
        </div>
        <div class="modal-body">
          <p>                                                      
          <input name="id" type="hidden" value="<?=$row['id']?>" />
          <input name="razon_social" type="text" class="form-control" value="<?="Nombre= " . $row['razon_social']?>" disabled />
          <input name="numero_rif" type="text" class="form-control" value="<?="Rif= ".$row['numero_rif']?>" disabled />
          <input name="direccion" type="text" class="form-control" value="<?="Direccion= " . $row['direccion_empresa']?>" disabled />
          </p>
        </div>
        <div class="modal-footer">
          <button name="modal_delete_empresa" value="eliminar" type="submit" class="btn btn-success">Si, eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>      
    </div>
  </form>
</div>