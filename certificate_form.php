<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_form.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $certificate_number = $_POST['certificate_number'];
    $company_name = $_POST['company_name'];
    $number_of_shares = $_POST['number_of_shares'];
    $drf_number = $_POST['drf_number'];

    $sql = "INSERT INTO certificates (customer_id, certificate_number, company_name, number_of_shares, drf_number, branch) 
            VALUES ('$customer_id', '$certificate_number', '$company_name', '$number_of_shares', '$drf_number', 'Assign Branch')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Certificate Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="post" action="">
            <h2>Certificate Information</h2>
            <input type="text" name="certificate_number" placeholder="Certificate Number" required>
            <input type="text" name="company_name" placeholder="Company Name" required>
            <input type="number" name="number_of_shares" placeholder="Number of Shares" required>
            <input type="text" name="drf_number" placeholder="DRF Number" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
