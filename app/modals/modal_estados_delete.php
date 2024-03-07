<div class="modal fade" id="deleteChildrensn<?=$row['id']?>" role="dialog">
  <form  method="post" action="../app/vistaEstadosCiudades.php">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Esta seguro de eliminar esta ciudad?</h4>
        </div>
        <div class="modal-body">
          <p>                                                      
          <input name="id" type="hidden" class="form-control" value="<?=$row['id']?>" />
          <input name="ciudad" type="text" class="form-control" value="<?="Ciudad= " . $row['city']?>" disabled />
          </p>
        </div>
        <div class="modal-footer">
          <button name="modal_delete_ciudad" value="eliminar" type="submit" class="btn btn-success">Si, eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>      
    </div>
  </form>
</div>