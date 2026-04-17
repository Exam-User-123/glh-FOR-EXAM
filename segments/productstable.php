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
                <?php if (isset($_SESSION["user_data"])): ?>
                    <button type="submit" name="addtocart" id="addtocart">Add to Cart</button>
                <?php endif; ?>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>