<div class="modal fade" id="deleteChildrensn<?=$row['idusuario']?>" role="dialog">
  <form  method="post" action="../app/vistaUsuario.php">
    <div class="modal-dialog">
        
      <!-- Modal content-->
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Esta seguro de eliminar este usuario?</h4>
        </div>
        <div class="modal-body">
          <p>                                                      
          <input name="idUsuario" type="hidden" class="form-control" value="<?=$row['idusuario']?>" />
          <input name="nombre" type="text" class="form-control" value="<?="Nombre= " . $row['nombre']?>" disabled />
          <input name="email" type="text" class="form-control" value="<?="email= ".$row['correo']?>" disabled />
          <input name="razon_social" type="text" class="form-control" value="<?="Empresa= " . 
		  $row['tipo'] == '3' ? $row['razon_social_proveedor'] : $row['razon_social_empresa']; ?>" disabled />
          </p>
        </div>
        <div class="modal-footer">
          <button name="modal_delete_user" value="eliminar" type="submit" class="btn btn-success">Si, eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>      
    </div>
  </form>
</div>