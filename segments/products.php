<?php
    include "connect.php";

    $products = [];

    $result = $conn->query("SELECT * FROM products");

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
?>