<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="success-container">
        <h2>Form Submission Successful!</h2>
        <a href="customer_home.php">Back to Home</a>
    </div>
</body>
</html>
