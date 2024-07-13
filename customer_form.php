<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $pan_number = $_POST['pan_number'];
    $bank_details = $_POST['bank_details'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO customers (name, email, phone_number, date_of_birth, address, pan_number, bank_details, created_at) 
            VALUES ('$name', '$email', '$phone_number', '$date_of_birth', '$address', '$pan_number', '$bank_details', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['customer_id'] = $conn->insert_id;
        header("Location: certificate_form.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="post" action="">
            <h2>Customer Information</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="date" name="date_of_birth" placeholder="Date of Birth" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="pan_number" placeholder="PAN Number" required>
            <input type="text" name="bank_details" placeholder="Bank Details" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
