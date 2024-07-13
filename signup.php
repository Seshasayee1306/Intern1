<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $password = md5($password); // Hash the password
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Insert credentials
            $sql = "INSERT INTO customer_credential (name, username, password, phone_number, email)
                    VALUES ('$name', '$username', '$password', '$phone_number', '$email')";
            $conn->query($sql);

            // Commit transaction
            $conn->commit();

            header("Location: login.php");
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
