<?php

$server = "localhost";
$username = "root";
$passwd = "root";

$conn = new mysqli($server, $username, $passwd);

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

?>