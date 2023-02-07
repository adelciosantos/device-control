<?php
	session_start();
	if(!isset($_SESSION['logon'])){
	  header('Location: login.php');
	}

	echo "
	<!DOCTYPE html>
	<html lang=\"pt-BR\">
		<head>
			<meta charset=\"UTF-8\">
			<meta name=\"viewport\" content=\"widht=device-widht, initial-scale=1.0\">
			<link type=\"text/css\" href=\"templates/stylesheet.css\" rel=\"stylesheet\">
			<link rel=\"icon\" href=\"img/icon.png\">
			<title>Atec Control</title>
		</head>
		 <body>
			<div id=\"site\">
		";
		
?>