<?php 
    session_start();
    $error = "";
    $total = 0;
    if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["checkout"]) && (isset($_SESSION["user_data"])))) {
        include "segments/connect.php";
        $json = json_encode($_SESSION["cart"]);
        $id = $_SESSION["user_data"][0];
        $stmt = $conn->prepare("INSERT INTO purchases(purchase_array, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $json, $id);

        if ($stmt->execute()) {
            $error = "Order successful!";
            header("Location: index.php");
        }
    }
    if (!isset($_SESSION["user_data"])) {
        $error = "Cannot purchase unless you have an account!";
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
        .hero {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include "segments/header.php"; ?>
    <div class="img" id="img">
        <img src="images/agricultural-contractor.webp" alt="A farmer in a wheat field">
    </div>
    <div class="hero" id="hero">
        <div class="cart2" id="cart2">
            <h1>Cart</h1>
            <?php if (!empty($_SESSION["cart"])): ?>
                <?php foreach ($_SESSION["cart"] as $item): ?>
                    <p>
                        <?= htmlspecialchars($item["product"]) ?> -
                        £<?= number_format($item["cost"], 2) ?> x
                        <?= $item["quantity"] ?>
                    </p>
                    <?php $total += $item["cost"]*$item["quantity"]; ?>
                <?php endforeach; ?>
                <p>Total: £<?= number_format($total, 2) ?></p>
                <form action="" method="post"><button name="checkout">Checkout</button></form>
            <?php else: ?>
                <p>There's nothing here!</p>
            <?php endif; ?>
        <br>
        <form action="buy.php" method="post"><button>Back</button></form>
        </div>
        <?php echo $error ?>
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
