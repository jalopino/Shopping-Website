<?php
session_start();
if ($_SESSION['status'] < 1 || empty($_SESSION['session_id'])) {
    header("location: index.php");
    exit();
}
?>
<html>
	<head>
		<title>Shopping Cart</title>
		<link rel = "stylesheet" type = "text/css" href = "../bootstrap/css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../styles/styles.css" />
		<script language = "javascript" src = "../bootstrap/js/bootstrap.js"></script>
		<script language = "javascript" src = "../js/jquery.js"></script>
	</head>
	<body>