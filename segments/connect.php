<?php
    $host = "localhost";
    $name = "root";
    $db = "glh";
    $pass = "";

    $conn = new mysqli($host, $name, $pass, $db);

    if (!$conn) {
        $error = $conn->connect_error;
    }
?>