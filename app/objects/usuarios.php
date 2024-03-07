    <?php
    class Usuarios
    {
        // database connection and table name
        private $conn;
        private $table_name = "usuario";
    
        // object properties
    
        // applying database conexion
        public function __construct ( $db )
        {
            $this->conn = $db;
        }

        function deleteUser ($idUsuario)
        {
            try {
                $query = "DELETE FROM " . $this->table_name . " WHERE idusuario= " . $idUsuario;
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                if($stmt->execute ()){
                    return true;	
                };
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function cambiarClave ($idusuario, $clave)
        {
            try {
                $query = "UPDATE " . $this->table_name . " SET clave='". $clave ."' WHERE idusuario= " . $idusuario;
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                if($stmt->execute ()){
                    return true;	
                };
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function leerUsuarioId ($id)
        {
            try {			 
                $query = "SELECT * FROM " . $this->table_name . " WHERE idusuario= " . $id;
                $stmt = $this->conn->prepare ( $query );
                $id = htmlspecialchars ( strip_tags ( $id ) );
                //echo "<br>" . $query;
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function leerUsuarioCategorias ($id)
        {
            try {			 
                $query = "SELECT idcategoria FROM usuario_categorias where idusuario = $id";
                $stmt = $this->conn->prepare ( $query );
                $id = htmlspecialchars ( strip_tags ( $id ) );
                //echo "<br>" . $query;
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function leerUsuarioCategoria ($id, $idcategoria)
        {
            try {			 
                $query = "SELECT idcategoria FROM usuario_categorias where idusuario = $id and idcategoria = $idcategoria";
                $stmt = $this->conn->prepare ( $query );
                $id = htmlspecialchars ( strip_tags ( $id ) );
                $idcategoria = htmlspecialchars ( strip_tags ( $idcategoria ) );
                //echo "<br>..." . $query;
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function leerUsuarioAdmin ($idCompany)
        {
            try {			 
                $query = "SELECT * FROM " . $this->table_name . " WHERE estado = 1 and userHive= " . $idCompany . " limit 1";
                $stmt = $this->conn->prepare ( $query );
                $stmt->execute ();
                //echo "<br><br><br><br><br>............................." . $query;
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function LeerUsuarioAcceso ($id, $cp)
        {
            try {
                $query = "SELECT b.userhive, b.nombre, b.usuario, a.* FROM detalle_permisos a inner join " . $this->table_name . 
                " b on (a.id_usuario = b.idusuario) where id_permiso = $cp and id_usuario = $id 
                and (agregar = 'A' or modificar = 'M' or eliminar = 'E' or consultar = 'C') limit 1";
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                $id = htmlspecialchars ( strip_tags ( $id ) );
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false;
            }
        }
        
            function readUserLogin ()
        {
            try {			 
                $query = "SELECT idusuario, nombre, correo, usuario, clave, estado, userhive, tipo, hint, 
                imagen, folder FROM " . $this->table_name . " WHERE estado = 1 and lcase(usuario)= '" . $this->usuario . "' 
                AND correo = '" . $this->email . "' LIMIT 1";
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                $this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
                $this->email	= htmlspecialchars ( strip_tags ( strtolower ( $this->email ) ) );
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        
        function readUser ()
        {
            try {			 
                $query = "SELECT idusuario, nombre, correo, usuario, clave, estado, userhive, tipo, hint, 
                imagen, folder FROM " . $this->table_name . " WHERE estado = 1 and lcase(usuario)= '" . $this->usuario . "' 
                AND clave = '" . md5($this->clave) . "' LIMIT 1";
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                $this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
                $this->clave	= htmlspecialchars ( strip_tags ( strtolower ( $this->clave ) ) );
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function readUserAdmin ()
        {
            try {			 
                $query = "SELECT idusuario, nombre, correo, usuario, clave, estado, userhive, tipo, hint, 
                imagen, folder FROM " . $this->table_name . " WHERE estado = 1 and lcase(usuario)= '" . $this->usuario . "' LIMIT 1";
                //echo "<br>" . $query;
                $stmt = $this->conn->prepare ( $query );
                $this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
                $this->clave	= htmlspecialchars ( strip_tags ( strtolower ( $this->clave ) ) );
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function LeerUsuarios ($tipoUsuario, $filtroNegocio)	// 0; todos, 1: administradores, 2: asistentes, 3:proveedores, 4: empresas
        {
            if( $filtroNegocio == 0){
                $filtro_negocio = "";
            }else{
                if($tipoUsuario <= 2){
                    $filtro_negocio = " and userhive = $filtroNegocio ";
                }else{
                    $filtro_negocio = " and userhive = $filtroNegocio ";	
                }
                
            }
            try {
                if ( isset($tipoUsuario) && ($tipoUsuario == 1 || $tipoUsuario == 2)){
                    $query = "SELECT idusuario, nombre, correo, usuario, clave, estado, userhive, 'Administracion' as razon_social, 
                    tipo, hint, imagen,	folder FROM " . $this->table_name . " WHERE idusuario >0 $filtro_negocio ORDER BY nombre";		
                    //echo "1<br>" . $query;
                }else{
                    if ( isset($tipoUsuario) && ($tipoUsuario == 3 )){
                        $query = "SELECT * FROM usuario_empresa WHERE tipo = 3 $filtro_negocio ORDER BY nombre";		
                        //echo "2<br>" . $query;
                    }else{
                        if ( isset($tipoUsuario) && ($tipoUsuario == 4 )){
                        $query = "SELECT * FROM usuario_proveedor WHERE tipo = 4 $filtro_negocio ORDER BY nombre";	
                        //echo "3<br>" . $query;
                        }
                    }
                }
                $stmt = $this->conn->prepare ( $query );
                //echo "<br>" . $query;
                $stmt->execute ();
                return $stmt;
            } catch(PDOException $e) {
                return false; // <== CAMBIAR AQUI
            }
        }
        
        function crearContacto ()
        {
            $query = "INSERT INTO " . $this->table_name . " SET 
            usuario='$this->usuario', 
            empresa='$this->empresa', 
            telefono='$this->telefono', 
            email='$this->email', 
            estado=$this->estado,  
            ciudad=$this->ciudad, 
            asunto = $this->asunto, 
            comentario='$this->comentario', 
            direccion='$this->direccion', 
            website='$this->website'";
            
            $stmt = $this->conn->prepare ( $query );
            $this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
            $this->empresa 	= htmlspecialchars ( strip_tags ( strtolower ( $this->empresa ) ) );
            $this->telefono = htmlspecialchars ( strip_tags ( strtolower ( $this->telefono ) ) );
            $this->email 	= htmlspecialchars ( strip_tags ( strtolower ( $this->email ) ) );
            $this->estado 	= htmlspecialchars ( strip_tags ( $this->estado ) );	
            $this->ciudad 	= htmlspecialchars ( strip_tags ( $this->ciudad ) );
            $this->asunto 	= htmlspecialchars ( strip_tags ( $this->asunto ) ); 
            $this->comentario = htmlspecialchars ( strip_tags ( strtolower ( $this->comentario ) ) );
            $this->direccion  = htmlspecialchars ( strip_tags ( strtolower ( $this->direccion ) ) );
            $this->website 	= htmlspecialchars ( strip_tags ( strtolower ( $this->website ) ) );
            
            //echo "usuario= " . $this->usuario . " " . $query;
            // execute.sql and detect any error, ok return true, else return false 		
            if($stmt->execute () )
            {
                //echo "con exito";
                return true;
            }
            return false; 
        }
    }
    ?>