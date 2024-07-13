<?php
session_start();
include 'db.php';

// Check if user is logged in as customer
if (!isset($_SESSION['customer'])) {
    header("Location: login.php");
    exit();
}

// Retrieve customer details based on username from session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM customer_credential WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $username = $row['username'];
        $phone_number = $row['phone_number'];
        $email = $row['email'];
    } else {
        echo "Error: Customer details not found.";
        exit();
    }
} else {
    echo "Error: Username not set in session.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h2>My Profile</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Username: <?php echo $username; ?></p>
        <p>Phone Number: <?php echo $phone_number; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
