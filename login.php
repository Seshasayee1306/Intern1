<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash the password

    // Check if admin credentials
    if ($username === 'admin' && $password === md5('Prabhabala##70')) {
        $_SESSION['user_type'] = 'admin'; // Store user type in session
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Check customer credentials
        $sql = "SELECT * FROM customer_credential WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['user_type'] = 'customer'; // Store user type in session
            $_SESSION['customer'] = true;
            $_SESSION['username'] = $username; // Store username in session
            header("Location: customer_home.php");
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
        <div class="signup-link">
            <a href="signup.php" class="button">Sign Up</a>
        </div>
    </div>
</body>
</html>
