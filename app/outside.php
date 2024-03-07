<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,	 initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>STRASOURCING - User Profile</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    
    <!-- END GLOBAL MANDATORY STYLES -->
    
     <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="../assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body class="sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <ul class="navbar-item flex-row">
                <li class="nav-item theme-logo" style="color:#000">
                    <a href="outside.php">
                    <img src="../assets/img/icon.png" alt="logo" width="150" class="navbar-logo"></a></li>
            </ul>

            <ul class="navbar-item flex-row search-ul">
                <li class="nav-item align-self-end search-animated">
                
                </li>
            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">
                <li class="nav-item dropdown notification-dropdown">
                     <strong><a href="login.php">Login Usuario</a></strong>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <strong><a href="registrate_gratis/comprador.php">Registro Compradores!</a></strong>
                </li>
                
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="registrate_gratis/proveedor.php">Registro Proveedores!</a></strong>
                </li>
                
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="contactanos.php">Contáctanos</a></strong>
                </li>
				
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <strong><a href="outside.php">Regresar</a></strong>
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN CONTENT AREA  id="content" -->
        <div class="container-fluid">
        <?php
			$alert="";
			If ( isset( $_GET['mensaje'] ) && $_GET['mensaje'] !="" ) {
				$alert = '<div class="alert alert-success" role="alert"> ' . $_GET['mensaje'] . '</div>';
			}	
		?>
            <div class="layout-px-spacing">
                <div class="page-header">
                    <div class="page-title">
                    
                        <h3>Servicio de Registro</h3>
                    </div>
                </div>
				
                <br>
                
                <div class="row layout-spacing">

                    <!-- Content -->
                    
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Sistema StraSourcing</h3>
                                    <a href="registrate_gratis/proveedor.php" class="mt-2 edit-profile"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                </div>
                                <div class="text-center user-info"><a href="#">
                                <!-- <img src="../assets/img/versiónvertical.png" alt="logo" width="150" class="navbar-logo">-->
                                </a>
                                  <p class=""><span style="color:#5B00B7;">Ventas: J.C. Latouche <br>Soporte: Carlos Peraza</span></p>
                                </div>
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line>
                                                </svg><span style="color:#5B00B7;">#29 Planta Alta</span></li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg><span style="color:#5B00B7;">C.C. Los Aviadores, Local </span></li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>
                                                </svg><span style="color:#5B00B7;">Valencia, VEN</span>
                                            </li>
                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                                                </svg><span style="color:#5B00B7;">ventas@strasourcing.com<br>
                                                soporte@strasourcing.com</span>
                                                </a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg> <span style="color:#5B00B7;">+58 (414) 484-0676</span>
                                            </li>
                                            <li class="contacts-block__item">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="education layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Videos Tutoriales</h3>
                                <div class="timeline-alter">
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">Definicion de StraSourcing</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>#1
                                        <div class="t-text">
                                            <p>Video Tutorial 1</p>
                                            <p>Video Tutorial 1</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">Como crear una cuenta?</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Cuentas de Compradores</p>
                                            <p>Cuenta de Proveedores</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">El directorio de proveedores</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Como buscar proveedores</p>
                                            <p>Como grabar a mis favoritos</p>
                                            <p>Como crear mis etiquetas de busqueda</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">Recomendaciones</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Mandando solicitudes</p>
                                            <p>Recibiendo respuesta de Clientes</p>
                                            <p>Que puedo hacer con las respuestas</p>
                                        </div>
                                    </div>
                                    
                                     <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">Hablemos de otros modulos</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Modulo de solicitud de cotizaciones</p>
                                            <p>Modulo de licitaciones abiertas</p>
                                            <p>Modulo de licitaciones cerradas</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="work-experience layout-spacing "></div>

                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                        

                        <div class="bio layout-spacing ">
   	                	<?php 					
						echo $alert;
						$alert="";
						
						include "controllers/mainControllerOut.php";
						
						/*
						
						Estadisticas del sitio:
						localhost
						
						nombre de la pagina web actual
						/STRASOURCING/app/outside.php
						
						Pagina web de donde viene el visitante
						http://localhost/STRASOURCING/app/login.php
						
						Nombre del navegador
						Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36
						
						Direccion Ip del visitante
						::1
						
						*/
						if (!isset($_SERVER['HTTP_REFERER'])){
							$_SERVER['HTTP_REFERER']="";	
						}
						date_default_timezone_set("America/Caracas"); 
						$bigdata_out->server_name = $_SERVER['SERVER_NAME'];			// nombre del servidor
						$bigdata_out->fecha = date('Y-m-d H:i:s');					// fecha y hora de visita
						$bigdata_out->php_self = $_SERVER['PHP_SELF'];					// nombre de la pagina web actual
						$bigdata_out->http_referer = $_SERVER['HTTP_REFERER'];				// de donde viene la pagina
						$bigdata_out->http_user_agent = $_SERVER['HTTP_USER_AGENT'];	// nombre del navegador
						$bigdata_out->remote_addr = $_SERVER['REMOTE_ADDR'];			// direccion ip el visitante
						$stmt = $bigdata_out->crearBigdata();
						
					?>
                            <div class="widget-content widget-content-area">
                                <h3 class="">Qué Ofrecemos...</h3>
                                <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p>

                                <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>

                                <div class="bio-skill-box">

                                    <div class="row">
                                        
                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div> 
                                                </div>
                                                <div class="">
                                                    <h5><a href="registrate_gratis/comprador.php"><img src="../assets/img/registroIcon.png" alt="logo" width="60" class="navbar-logo"></a> Registro de Empresas</h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5><a href="registrate_gratis/proveedor.php"><img src="../assets/img/registroIcon.png" alt="logo" width="60" class="navbar-logo"></a> Registro de Proveedores</h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5> <a href="contactanos.php"><img src="../assets/img/contact-us-icon.png" alt="logo" width="60" class="navbar-logo"> Contáctanos</a></h5>
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia anim id est laborum.<br>
                                                      <br>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                  <p>&nbsp;</p>
                                                  <p>&nbsp;</p>
                                                </div>
                                              <div class="">
                                                    <h5>&nbsp;</h5>
                                                  <h5><a href="index.html"><img src="../assets/img/home-button-icon.png" alt="logo" width="60" class="navbar-logo"></a> Regresar                                                al menú principal<br>
                                                  <br>  
                                                  </h5>
                                                </div>
                                            </div>
<br><br>
                                        </div>

                                    </div>

                                </div>

                            </div>                                
                        </div>
                        
                        <div class="bio layout-spacing ">
                        	
                             <div class="row">
                                <div class="col-lg-12 layout-spacing">
                                    <div class="statbox widget box box-shadow">
                                        <div id="accordionIcons" class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                    <h4>Preguntas más frecuentes</h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="widget-content widget-content-area">
                                            <div id="iconsAccordion" class="accordion-icons">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne3">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionOne" aria-expanded="true" aria-controls="iconAccordionOne">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                                1.	¿Cómo puedo registrarme en StraSourcing si soy un Proveedor?  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
        
                                                    <div id="iconAccordionOne" class="collapse" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                                        <div class="card-body">
                                                            <p class="">
                                                            Deberá seleccionar como primer paso la opción de “registrarse” que aparece en pantalla, bien sea como Proveedor o Comprador. Una vez seleccionada la opción de registro como proveedor, deberá llenar un formulario en el cual se le solicitará información general de la empresa, productos y/o servicios que ofrece, categorías asociadas a sus productos o servicios, marcas comercializadas, redes sociales, entre otras.                                                   
                                                            </p>
        
                                                            <p class="">
                                                            	Después de ser adicionada toda la información requerida, el equipo de StraSourcing procederá a evaluar dicha información para su aprobación y así poder acceder a StraSourcing y disfrutar de los servicios que la solución ofrece. 
                                                           	</p>  
                                                        </div>
                                                    </div>
                                              </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo3">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionTwo" aria-expanded="false" aria-controls="iconAccordionTwo">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                                                                2.	¿Cómo puedo registrarme en StraSourcing si soy un Comprador?  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionTwo" class="collapse" aria-labelledby="headingTwo3" data-parent="#iconsAccordion">
                                                        <div class="card-body">
                                                            <p class="">
                                                            Deberá seleccionar como primer paso la opción de “registrarse” que aparece en pantalla, bien sea como Proveedor o Comprador. Una vez seleccionada la opción de registro como Comprador, deberá llenar un formulario en el cual se le solicitará información general de la empresa que desea registrase como comprador, sector industrial al cual pertenece, tipo de organización y listado de compradores asociados a la empresa solicitante del acceso a la solución digital.  
															</p>
                                                            <p class="">
															Después de ser adicionada toda la información requerida el quipo de Strasourcing procederá a evaluar dicha información para su aprobación y así poder acceder a Strasourcing y disfrutar de los servicios que la solución ofrece.
                                                            </p> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionThree" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                3.	¿En cuantas categorías puede registrase el proveedor? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionThree" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Los proveedores podrán registrase como máximo en 4 categorías. De requerir acceso a otras categorías, deberá contactar al equipo de Strasourcing para su evaluación.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionFour" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                4.	¿Los compradores tienen acceso a todas las categorías? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionFour" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionFive" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                5.	¿Cuánto debo pagar para tener acceso a Strasourcing como proveedor? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionFive" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionSix" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                6.	¿Cuánto debo pagar para tener acceso a Strasourcing como Comprador? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionSix" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                               	 <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionSeven" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                7.	¿Cuáles son los métodos de pago en Strasourcing? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionSeven" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionEight" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                8.	¿Se pueden realizar procesos de licitación en Strasourcing? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionEight" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionNine" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                9.	¿Se pueden  vender a través de Strasourcing? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionNine" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                               	 <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionTen" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                10.	¿Existen algún certificado de verificación generado por strasourcing / CIEC? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionTen" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                    <div class="card-body">
                                                        <p class="">
														Si, los compradores una vez aprobados su acceso podrán acceder a todas las categorías disponibles para la búsqueda de proveedores de bienes o servicios a nivel nacional registrados a la fecha de búsqueda.
                                                        </p> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree8">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionEleven" aria-expanded="false" aria-controls="iconAccordionThree">
                                                                <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                                11.	¿Cómo puedo ponerme en contacto con StraSourcing? <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="iconAccordionEleven" class="collapse" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                                        <div class="card-body">
                                                            <p class="">
                                                            Seleccionando la opción “contacto” aparecerá en pantalla un formulario que deberá llenar con información general de la empresa y persona que está realizando el contacto. 
    Luego de llenada la información, deberá seleccionar el motivo del contacto en la opción “asunto” o escribirlo según sea el caso, para este último deberá seleccionar “otro” de no ubicar el motivo de contacto a Strasourcing.
    Una vez completada la información y enviada al equipo de soporte de Strasourcing se procederá a evaluarla para su posterior respuesta en las 48 horas vía correo. 
    </p> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										</div>
                                    </div>

                                    <!--<div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                            
                            <div class="widget-content widget-content-area">
                                <h3 class="">Respuesta a las preguntas frecuentes y de los Blogs</h3>
                                <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p>

                                <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>
                                
                                 <h3 class="">Respuesta a las preguntas frecuentes y de los Blogs</h3>
                                <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p>

                                <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate. varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut </p>

                                <div class="bio-skill-box">

                                    <div class="row">
                                        
                                        <div class="container"> Aqui va mas informacion...</div>

                                    </div>

                                </div>

                            </div>                                
                        </div>

                    </div>-->
                    

                </div>
                </div>
        <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2023 <a target="_blank" href="https://strasourcing.com">straSourcing.com</a>, Todos los derechos</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
    </div>
    <!--  END CONTENT AREA  -->

  </div>
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../bootstrap/js/popper.min.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
});
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../assets/js/components/ui-accordions.js"></script>
    <!-- END PAGE LEVEL SCRIPTS --> 
    
</body>
</html>