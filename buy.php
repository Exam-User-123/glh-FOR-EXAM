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
        <table>
            <tr>
                <th>Product Image</th>
                <th>Information</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="<?= $product["product_image"] ?>" alt="<?php $product["product_name"] ?>"></td>
                <td>
                    <h4><?= $product["product_name"] ?></h4>
                    <h5>£<?= $product["product_cost"] ?></h5>
                    <h5>In Stock: <?= $product["product_stock"] ?></h5>
                    <p><?= $product["product_desc"] ?></p>
                    <br>
                    <form action="" method="post">
                        <input type="text" name="productname" hidden value="<?= $product["product_name"] ?>">
                        <input type="number" name="productcost" hidden value="<?= $product["product_cost"] ?>">
                        <input type="number" name="productstock" hidden value="<?= $product["product_stock"] ?>">
                        <button type="submit" name="addtocart" id="addtocart">Add to Cart</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div id="vr" class="vr"></div>
        <div class="cart" id="cart">
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
    <form action="checkout.php" method="post"><button>Checkout</button></form>
<?php endif; ?>
            <br>
            <form action="" method="post"><button type="submit" name="clearcart">Clear Cart</button></form>
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