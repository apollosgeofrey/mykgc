<!DOCTYPE html>
<!-- saved from url=(0028) -->
<html>
	<!-- head -->
	<head>
		<?php
			//this is where i require the conection to server
			session_start();
			 require('server_db_connection.php'); server_db_conn(); 
			 date_default_timezone_set('Africa/Lagos');
			 $ipaddr = $_SERVER['REMOTE_ADDR'];
			 include "sitevisitors.php";
		?>

		<title>KGCPAY-Tax</title>

	<!-- My own Files -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/bootstrap.min.js"></script>
  		<script src="js/jquery-2.1.4.min.js"></script>
  		
  	<!-- this is for recaptcha-->
  		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
 
  		<!-- bootstrap & fontawesome -->
	  	<link rel="stylesheet" href="font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- //End of My Own Files -->

		<link href="WTH-Tax_files/bootstrap.css" rel="stylesheet" type="text/css" media="all">

		<!-- bootstrap-CSS -->
		<link rel="stylesheet" href="WTH-Tax_files/bootstrap-select.css">

		<!-- Fontawesome-CSS -->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script type="text/javascript" src="WTH-Tax_files/jquery-2.2.3.min.js"></script>

		<!-- Custom Theme files -->
		<!--theme-style-->
		<link href="WTH-Tax_files/style.css" rel="stylesheet" type="text/css" media="all">

		<!--//theme-style-->
		<!--meta data-->
		<meta name="auto" content="Kokozum Global Concepts" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<meta name="”description”" content="Pay your Witholden taxes to Kokozum Global Concepts in fast easy steps to the Nasarawa State Board of Internal Revenue">
		<meta name="keywords" content="Tax, witholding tax, Nasarawa state, Nigeria, Lafia, online, payment, flutter_wave, PSIRS, internal revenue, pay tax">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--//meta data-->


		<!-- here favicon was included -->
		<link rel="android-chrome" sizes="512x512" href="frontend/favicon/android-chrome-512x512.png">
		<link rel="android-chrome" sizes="192x192" href="frontend/favicon/android-chrome-192x192.png">
		<link rel="apple-touch-icon" sizes="180x180" href="frontend/favicon/apple-touch-icon.png">
		<link rel="favicon" sizes="48x48" href="frontend/favicon/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="frontend/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="frontend/favicon/favicon-16x16.png">
		<link rel="manifest" href="frontend/favicon//site.webmanifest">
	</head>
	<!-- //head -->