<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include "segments/connect.php";

        $name = $_POST["productname"];
        $info = $_POST["productdesc"];
        $cost = $_POST["productcost"];
        $stock = $_POST["productstock"];
        $img = "images/" . $_POST["productimage"];
        $error = "";

        if (!filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $error = "Invalid product name";
        }

        if (!filter_var($info, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $error = "Invalid product info";
        }

        if (!filter_var($cost, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $error = "Invalid cost";
        }

        $stmt = $conn->prepare("INSERT INTO products (product_name, product_desc, product_stock, product_cost, product_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdds", $name, $info, $stock, $cost, $img);

        if ($stmt->execute()) {
            $error = "Item successfully added!";
        } else {
            $error = "Item has not been added";
        }


    header("Location: index.php");
    $conn->close();
    $stmt->close();
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
    <style>
        #hero {
            height: 800px;
        }
    </style>
</head>
<body>
    <?php include "segments/header.php"; ?>
    <div class="img" id="img">
        <img src="images/agricultural-contractor.webp" alt="A farmer in a wheat field">
    </div>
    <div class="hero" id="hero">
        <h1>Selling Products</h1>
        <p>New to selling products? It's simple!</p>
        <form action="" method="post">
            <label for="productname">Product Name</label><br>
            <input type="text" name="productname" id="productname"><br><br>
            <label for="productinfo">Product Description</label><br>
            <input type="text" name="productdesc" id="productdesc"><br><br>
            <label for="productcost">Product Cost</label><br>
            <input type="number" name="productcost" id="productcost" min="0" step="0.01"><br><br>
            <label for="productstock">Product Stock</label><br>
            <input type="number" name="productstock" id="productstock" min="0" step="1"><br><br>
            <label for="productimage">Product Image</label><br>
            <input type="file" name="productimage" id="productimage" accept="image/*"><br><br>
            <button type="submit">Go</button>
        </form>
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