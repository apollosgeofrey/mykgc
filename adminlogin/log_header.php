<!DOCTYPE html>
<!-- saved from url=(0033)http://wthtax.herokuapp.com/login -->
<html lang="en" class="perfect-scrollbar-on">
<?php 
    //this is where i require the conection to server
        session_start();
        require('../server_db_connection.php'); server_db_conn(); 
        date_default_timezone_set('Africa/Lagos');
        $ipaddr = $_SERVER['REMOTE_ADDR'];
        include "../sitevisitors.php";
?>
    <head>
    <!-- My own Files -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-2.1.4.min.js"></script>
        
    <!-- this is for recaptcha-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="../font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- //End of My Own Files -->

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="wB3h7nACQwhV91pvNmqPMQoAlhQObTukz2fjEXQg">

        <title>Admin Login Dashboard</title>
     <!-- Favicon -->
        <link rel="android-chrome" sizes="512x512" href="frontend/favicon/android-chrome-512x512.png">
        <link rel="android-chrome" sizes="192x192" href="frontend/favicon/android-chrome-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="frontend/favicon/apple-touch-icon.png">
        <link rel="favicon" sizes="48x48" href="frontend/favicon/favicon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="frontend/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="frontend/favicon/favicon-16x16.png">
        <link rel="manifest" href="frontend/favicon//site.webmanifest">
    <!-- Fonts -->

        <!-- CSS -->
        <link href="scripts_awesomes/black-dashboard.css" rel="stylesheet">

    </head>

<body class="login-page">
  <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">KGCTax | Admin Login</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-primary">
                        <i class="fa fa-home"></i> Back to Dashboard
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="index.php" class="nav-link">
                        <i class="fa fa-sign-in"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>