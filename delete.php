<?php
include 'dbconnect.php';
$Id = $_GET['Id'];
$sql = "DELETE FROM student WHERE Id = '$Id'";

$result= mysqli_query($conn, $sql);

?>