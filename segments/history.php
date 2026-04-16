<?php
    include "connect.php";

    $stmt = $conn->query("SELECT * FROM purchases");

    $purchases = [];

    while ($row = $stmt->fetch_assoc()) {
        $purchases[] = $row;
    }
?>