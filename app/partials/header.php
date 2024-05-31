<?php 
include "../controllers/mainController.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="">
	<meta name="author" content="">
    
    <title>STRASOURCING - HEADER </title>
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png"/>
    <link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES 
    <link href="../plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">-->
    <link href="../assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" class="dashboard-sales" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <!-- BEGIN JQUERY 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
    <!-- END PAGE JQUERY 3.3.1 -->

</head>
<body class="sidebar-noneoverflow dashboard-sales">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN SIDEBAR  -->
    <?php include "partials/navbar.php"?>
    <!--  END SIDEBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>