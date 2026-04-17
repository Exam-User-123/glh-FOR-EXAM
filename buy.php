<?php
// 1. Check if session is already active; if not, start it.
// This handles cases where your header might or might not have started it.
session_start();
// 2. LOAD DATA FIRST (Before HTML)
include "segments/products.php"; 

$error = "";
$total = 0;

// 3. PROCESS POST DATA (Before HTML)
// We do this here so we can handle errors before the page renders
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["clearcart"])) {
        $_SESSION["cart"] = [];
    }

    if (isset($_POST["addtocart"])) {
        $name = $_POST["productname"] ?? "";
        $cost = (float)($_POST["productcost"] ?? 0);
        $stock = (int)($_POST["productstock"] ?? 0);

        // Standard Cart Logic...
        if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];
        
        $found = false;
        foreach ($_SESSION["cart"] as &$item) {
            if ($item["product"] === $name) {
                $found = true;
                ($item["quantity"] < $stock) ? $item["quantity"]++ : $error = "Out of stock!";
                break;
            }
        }
        unset($item);

        if (!$found && $stock > 0) {
            $_SESSION["cart"][] = ["product" => $name, "cost" => $cost, "quantity" => 1];
        } elseif (!$found) {
            $error = "Out of stock!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="glh.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/*">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenfield Local Hub</title>
</head>
<body>
    <?php include "segments/header.php"; ?>
    <div class="img" id="img">
        <img src="images/agricultural-contractor.webp" alt="A farmer in a wheat field">
    </div>
    <div class="hero" id="hero">
        <h1>Products</h1>
        <p><?= $error ?></p>
        <?php include "segments/productstable.php"; ?>
        <?php include "segments/cartone.php"; ?>
        </div>
    </div>
    <?php include "segments/footer.php"; ?>
</body>
</html>
<script>
    if (localStorage.getItem("contrast") === "on") {
        document.body.classList.add("contrast");
    } else {
        document.body.classList.remove("contrast");
    }
</script>
