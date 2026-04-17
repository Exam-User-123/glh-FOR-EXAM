<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include "segments/connect.php";

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $error = "";

        if (!filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $error = "Invalid Username";
        }
        if (empty($username)) {
            $error = "Invalid Username";
        }
        if (!filter_var($email, FILTER_SANITIZE_EMAIL) || strlen($email) <= 0) {
            $error = "Invalid Email";
        }
        if (empty($email)) {
            $error = "Invalid Email";
        }
        if (strlen($password) < 6) {
            $error = "Password is too short";
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user_data"] = array($user["id"], $user["username"], $user["role"], $user["mode"]);
                header("Location: index.php");
            } else {
                $error = "Passwords do not match";
            }
        }

        $stmt->close();
        mysqli_close($conn);
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
        <h1>Log In</h1>
        <form action="" method="post">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username"><br><br>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email"><br><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password"><br><br>
            <button type="submit">Log In</button>
        </form><br>
        <?php 
            if (empty($error)) {
                echo "";
            } else {
                echo $error;
            }
        ?>
        <div id="noaccount">Don't have an account? Sign up <a href="signup.php">here!</a></div>
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
