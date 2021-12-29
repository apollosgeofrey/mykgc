
<!DOCTYPE html>
<!-- saved from url=(0032)#home -->
<html lang="en" class="perfect-scrollbar-on">
<?php 
    //this is where i require the conection to server
ob_start();
        session_start();
        require('../server_db_connection.php'); server_db_conn(); 
        date_default_timezone_set('Africa/Lagos');
        $ipaddr = $_SERVER['REMOTE_ADDR'];
        include "../sitevisitors.php";
        require "session_checker.php";
?>
    <head>
                <!-- here favicon was included -->
        <link rel="android-chrome" sizes="512x512" href="../frontend/favicon/android-chrome-512x512.png">
        <link rel="android-chrome" sizes="192x192" href="../frontend/favicon/android-chrome-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../frontend/favicon/apple-touch-icon.png">
        <link rel="favicon" sizes="48x48" href="../frontend/favicon/favicon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../frontend/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../frontend/favicon/favicon-16x16.png">
        <link rel="manifest" href="../frontend/favicon//site.webmanifest">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="cS1DwmlqdF93F4WjL4aFZbAxNJ0wlanMr6RhGm2v">

 <!-- this is for recaptcha-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        
        <title>My Dashbord</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="#black/img/apple-icon.png">
        <link rel="icon" type="image/png" href="#black/img/favicon.png">
        <!-- Fonts -->
        <link href="general_scripts_awesome/css" rel="stylesheet">
        <link href="general_scripts_awesome/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="general_scripts_awesome/nucleo-icons.css" rel="stylesheet">
         <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="../font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="general_scripts_awesome/black-dashboard.css" rel="stylesheet">
        <link href="general_scripts_awesome/theme.css" rel="stylesheet">
    <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
    
    <body class="">
<div class="sidebar">
    <div class="sidebar-wrapper ps">
        <div class="logo">
            <a class="simple-text logo-normal">My Dashboard</a>
        </div>
        <ul class="nav">
            <li>
                <a href="dash_home.php">
                    <i class="fa fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fa fa-user"></i>
                        <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="user.php">
                    <i class="fa fa-gear"></i>
                    <p>User Management</p>
                </a>
            </li>
            <li>
                <a href="invoice_history.php">
                    <i class="fa fa-history"></i>
                    <p>Invoices history</p>
                </a>
            </li>
            <!--<li>
                <a href="#create.php">
                    <i class="fa fa-list"></i>
                    <p>Enumeration</p>
                </a>
            </li>-->
            <li>
                <a href="pay_history.php">
                    <i class="fa fa-money"></i>
                    <p>Payments history</p>
                </a>
            </li>
        </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
                <div class="main-panel ps">
                    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="search-bar input-group">
                    <button class="btn btn-primary" id="search-button" data-toggle="modal" data-target="#searchModal">
                        <span class="fa fa-search">Search</span>
                    </button>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="photo">
                            <img src="general_scripts_awesome/anime3.png" alt="Profile Photo">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">Log out</p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="dash_home.php" class="nav-item dropdown-item">Profile</a>
                        </li>
                        <li class="nav-link">
                            <a href="profile.php" class="nav-item dropdown-item">Settings</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a href="logout.php" class="nav-item dropdown-item">Log out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form action="search_resulter.php" method="get" autocomplete="on">
                    <input type="text" required="" class="form-control" id="inlineFormInputGroup" name="search_val" placeholder="Search KGC Payments REF">
                    <button type="submit" name="search_submit" aria-label="Search" value="sdfsdsdfsdsearchsdfsdfsd_ssdfsdfsdsubmitsdfsdfsd">
                        <i class="fa fa-search"></i>
                   </button>
                </form>
            </div>
        </div>
    </div>
</div>
