<?php session_start() ?>
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
        <img id="cycle" src="images/agricultural-contractor.webp" alt="A farmer in a wheat field">
    </div>
    <div class="hero" id="hero">
        <?php if(!isset($_SESSION["user_data"])): ?>
            <h1>Hi</h1>
        <?php else: ?>
            <h1>Hi, <?= $_SESSION["user_data"][1] ?></h1>
        <?php endif; ?>
        <p>Text can be put here in the case that you would require it for usage, as you would know.</p>
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