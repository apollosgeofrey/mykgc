<?php
//server connection function
	function server_db_conn(){
		$servername = "localhost";
		$serverusername = "root";
		$serverpass = "";
		$databasename = "kokozum_payment";
		global $conn;
		$conn = mysqli_connect($servername, $serverusername, $serverpass, $databasename);
	}
?>
