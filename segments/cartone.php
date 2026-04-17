<?php if (isset($_SESSION["user_data"])): ?>
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
<?php else: ?>
    <p>Cannot purchase unless you have an account!</p>
<?php endif; ?>