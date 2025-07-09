<?php

$host = "localhost";
$username = "root";
$pass = "";
$db = "swday";

$conn = mysqli_connect($host, $username, $pass, $db);

if (!$conn) {
    echo die('database not connected');
}

?>