<div class="modal fade" id="deleteChildrensn<?=$row['id']?>" role="dialog">
  <form  method="post" action="../app/vistaContactanos.php">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Esta seguro de eliminar este mensaje?</h4>
        </div>
        <div class="modal-body">
          <p>                                                      
          <input name="id" type="hidden" class="form-control" value="<?=$row['id']?>" />
          <input name="fecha" type="text" class="form-control" value="<?="Fecha= " . $row['date']?>" disabled />
          <input name="usuario" type="text" class="form-control" value="<?="Usuario= " . $row['usuario']?>" disabled />
          <input name="comentario" type="text" class="form-control" value="<?="Comentario= " . $row['comentario']?>" disabled />
          </p>
        </div>
        <div class="modal-footer">
          <button name="modal_delete_contactanos" value="eliminar" type="submit" class="btn btn-success">Si, eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>      
    </div>
  </form>
</div>