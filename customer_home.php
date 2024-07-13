<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file (e.g., db.php)
include 'db.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM customer_credential WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
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
    <title>Customer Home</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        /* Additional CSS for buttons in the header */
        header {
            background-color: #f0f0f0;
            padding: 10px;
            display: flex;
            justify-content: space-between; /* Align items with space between them */
            align-items: center; /* Align items vertically */
        }
        .button-container {
            margin-right: 20px; /* Adjust margin for spacing */
        }
        .button-container .button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <!-- Add your logo or site name here if needed -->
        </div>
        <div class="button-container">
            <a href="profile.php" class="button">My Profile</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </header>
    <main>
        <h1>Welcome, <?php echo htmlspecialchars($name); ?></h1>
        <div class="button-container">
            <a href="about_us.php" class="button">About Us</a>
            <a href="explore.php" class="button">Explore</a>
            <a href="contact_us.php" class="button">Contact Us</a>
            <a href="customer_form.php" class="button">Demat Form</a>
        </div>
        <div class="content-container">
            <h2></h2>
            <p></p>
        </div>
    </main>
</body>
</html>
