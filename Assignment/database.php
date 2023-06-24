<?php
    $host = "localhost";
    $user = "root";
    $password = "root";
    $database = "assignment_db";

    $conn = mysqli_connect($host,$user,$password,$database);

    if(!$conn) die("Failed to connect! ". mysqli_connect_error());
?>