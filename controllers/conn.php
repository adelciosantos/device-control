<?php

$server = "localhost";
$username = "atecs741_root";
$passwd = "@atec@";

$conn = new mysqli($server, $username, $passwd);

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

?>