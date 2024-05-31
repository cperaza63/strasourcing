<?php 
include "config/conexion.php";
session_start();
$accion = "";
if (!isset($_SESSION['accion_spa'])){
$_SESSION['accion_spa'] = "";	
}
if ( isset( $_GET['accion'] ) ){
	$accion = $_GET['accion'];
	$_SESSION['accion_spa'] = $accion;
}else{
	$accion = $_SESSION['accion_spa'];
}

if (empty($_SESSION['active'])  && $accion != "spa" ) {
    header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel de Administración</title>
    <link href="../../includes/css/styles.css" rel="stylesheet" />
    <link href="../../includes/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../includes/js/libs/jquery-3.1.1.min.js">
    <script src="../../includes/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
	</body>
		<?php
        if( $accion != "spa"){
        ?>
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">S P A - Venezuela</a>
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        
                <!-- Navbar-->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevo_pass">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="salir.php">Cerrar Sessión</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
        
                                <a class="nav-link" href="empresas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Empresas
                                </a>
                                
                                <a class="nav-link" href="proveedores.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Proveedores
                                </a>
        
                                <a class="nav-link" href="usuarios.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Usuarios
                                </a>
                                
                                <a class="nav-link" href="estadociudad.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Estados y Ciudades
                                </a>
        
                                <a class="nav-link" href="consulta_contactanos.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Contactanos
                                </a>
        
                                <a class="nav-link" href="catsubcat.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Cat/Subcat y Grupos
                                </a>
                                
                                <a class="nav-link" href="tablas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Control de Tablas
                                </a>
        
                                <a class="nav-link" href="config.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                    Configuración
                                </a> <br>
                                LIBRERIA DE PROGRAMAS
                                <a class="nav-link" href="distribuidores.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Distribuidores
                                </a>
        
                                <a class="nav-link" href="compradores.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Compradores
                                </a>
        
                                <a class="nav-link" href="consulta_pdf.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Pacientes
                                </a>
        
                                <a class="nav-link" href="cargar_imagenes.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Cargar imágenes
                                </a>
                                
                                <a class="nav-link" href="subirUnArchivo.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Cargar un archivo
                                </a>
        
                                <a class="nav-link" href="fullcalendar.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Calendario
                                </a>
        
                                <a class="nav-link" href="select_pais.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Paises
                                </a>
        
                                <a class="nav-link" href="navbar_bt4.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    NavBar
                                </a>
        
                                <a class="nav-link" href="llenar_select.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Llenar Select
                                </a>
        
                                <a class="nav-link" href="star_rating.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Star Rating
                                </a>
        
                                <a class="nav-link" href="categorias_infinitas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Categorias_infinitias
                                </a>
        
                                <a class="nav-link" href="select2.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Select 2
                                </a>
        
                                <a class="nav-link" href="eliminar_multiples.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Eliminar multiples
                                </a>
        
                                <a class="nav-link" href="subirImagenes.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Subir Imagenes
                                </a>
        
                                <a class="nav-link" href="geolocalizacionIP.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Geolocalizacon IP
                                </a>
        
                                <a class="nav-link" href="buscar_en_columnas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Buscar en Columnas
                                </a>
        
                                <a class="nav-link" href="crud_multiples_imagenes.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                    Multiples imágenes
                                </a>
        
                                <a class="nav-link" href="multiple_checkbox.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Multiple Checkbox
                                </a>
                                
                                <a class="nav-link" href="puntosApoyo.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Proveedores
                                </a>
                                
                                    <a class="nav-link" href="marcas.php">
                                    <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                                    Productos
                                </a>
        
        
                                <!--
                                <a class="nav-link" href="usuariosColmena.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Usuarios Colmena
                                </a>
                                -->
                                                        <!--
                                <a class="nav-link" href="ventas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                    Nuevas Ventas
                                </a>
                                <a class="nav-link" href="ventasAPP.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                    Ventas por APP
                                </a>
        
                                <a class="nav-link" href="lista_ventas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                                    Consulta de Ventas
                                </a>
                               
                                <a class="nav-link" href="requisiciones.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                                    Requisiciones
                                </a>
        
                                <a class="nav-link" href="lista_requisiciones.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                                    Consulta Requisiciones
                                </a>
                                 -->
                                <!--                  
                                <a class="nav-link" href="patrocinadores.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Patrocinadores
                                </a>
                                -->
        
                            </div>
                        </div>
                    </nav>
                </div>
        <?php
        }
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">