<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="glh.css">
    <title>Header</title>
</head>
<body>
    <header id="header">
        <a href="index.php"><img height="165px" src="images/logo.png" alt="Greenfield Local Hub logo"></a>
        <nav>
            <a href="buy.php">Buy</a>
            <?php if (!isset($_SESSION["user_data"])): ?>
                <a href="login.php"><button id="login">Log In</button></a>
            <?php else: ?>
                <?php if ($_SESSION["user_data"][2] === "producer" || $_SESSION["user_data"][2] === "admin"): ?>
                    <a href="sell.php">Sell</a>
                <?php else: ?>
                <?php endif; ?>
                <a href="profile.php">Profile</a>
                <a href="logout.php"><button id="logout">Log Out</button></a>
            <?php endif; ?>
        </nav>
        <button onclick="hamburger()" name="hamburger" id="hamburger">☰</button>
    </header>
    <div id="menu">
        <nav>
            <a href="buy.php">Buy</a>
            <?php if (!isset($_SESSION["user_data"])): ?>
                <a href="login.php"><button id="login">Log In</button></a>
            <?php else: ?>
                <?php if ($_SESSION["user_data"][2] === "producer" || $_SESSION["user_data"][2] === "admin"): ?>
                    <a href="sell.php">Sell</a>
                <?php else: ?>
                <?php endif; ?>
                <a href="profile.php">Profile</a>
                <a href="logout.php"><button id="logout">Log Out</button></a>
            <?php endif; ?>
        </nav>
    </div>
</body>
</html>
<script>
function hamburger() {
    let thing = document.getElementById("menu");
    if (thing.style.display === "inline-block") {
        thing.style.display = "none";
    } else {
        thing.style.display = "inline-block";
    }
}
</script>