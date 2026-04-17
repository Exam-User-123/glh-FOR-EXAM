<?php 
    session_start();
    include "segments/history.php";
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
        <h1>Profile</h1>

        <h3>High Contrast</h3>
        <div id="currentmode"></div>
        <form action="" method="post">
            <button id="contrastbutton" name="enable" value="1" onclick="enable()"></button>
        </form>

        <?php if ((!$purchases)): ?>
        <h3>Order History</h3>
        <?php foreach ($purchases as $purchase): ?>
            <?php if ($purchase["user_id"] === $_SESSION["user_data"][0]): ?>
            <p>Purchase <?= $purchase["purchase_id"] ?> - <?= $purchase["purchase_array"] ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php else: ?>
            <p>Nothing else to look at!</p>
        <?php endif; ?>
    </div>
    <?php include "segments/footer.php"; ?>
</body>
</html>
<script>
    const toggle = document.getElementById("contrastbutton");
    const mode = document.getElementById("currentmode");

    if (localStorage.getItem("contrast") === "on") {
        document.body.classList.add("contrast");
    }

    if (localStorage.getItem("contrast") === "on") {
        document.body.classList.add("contrast");
        mode.innerHTML = `Currently: ON`;
        toggle.innerHTML = `Disable`;
    } else {
        document.body.classList.remove("contrast");
        mode.innerHTML = `Currently: OFF`;
        toggle.innerHTML = `Enable`;
    }

    toggle.addEventListener("click", () => {
        document.body.classList.toggle("contrast");

        if (document.body.classList.contains("contrast")) {
            localStorage.setItem("contrast", "on");
            
        } else {
            localStorage.setItem("contrast", "off");
            
        }
    });
</script>
