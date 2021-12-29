<?php
session_start();
if (isset($_SESSION['email']) || isset($_SESSION['rank'])) {
	session_destroy();
	header("Location: index.php");
} else {
	session_destroy();
	header("location: index.php");
}
?>