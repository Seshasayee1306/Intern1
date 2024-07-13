<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Fetch demat details
$sql_demat = "SELECT d.*, c.name, c.email, c.phone_number, c.address, c.date_of_birth, c.pan_number, c.bank_details, c.created_at 
              FROM demat d 
              LEFT JOIN customers c ON d.customer_id = c.customer_id";
$result_demat = $conn->query($sql_demat);

// Fetch drf details
$sql_drf = "SELECT d.*, c.name, c.email, c.phone_number, c.address, c.date_of_birth, c.pan_number, c.bank_details, c.created_at 
            FROM drf d 
            LEFT JOIN customers c ON d.customer_id = c.customer_id";
$result_drf = $conn->query($sql_drf);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Branches</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Branch Details</h1>

    <h2>Demat Branch</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Date of Birth</th>
            <th>PAN Number</th>
            <th>Bank Details</th>
            <th>Created At</th>
            <th>Certificate Number</th>
            <th>Company Name</th>
            <th>Number of Shares</th>
            <th>DRF Number</th>
            <th>Branch</th>
        </tr>
        <?php
        while ($row = $result_demat->fetch_assoc()) {
            echo "<tr>
                <td>{$row['customer_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>{$row['pan_number']}</td>
                <td>{$row['bank_details']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['certificate_number']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['number_of_shares']}</td>
                <td>{$row['drf_number']}</td>
                <td>{$row['branch']}</td>
            </tr>";
        }
        ?>
    </table>

    <h2>DRF Branch</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Date of Birth</th>
            <th>PAN Number</th>
            <th>Bank Details</th>
            <th>Created At</th>
            <th>Certificate Number</th>
            <th>Company Name</th>
            <th>Number of Shares</th>
            <th>DRF Number</th>
            <th>Branch</th>
        </tr>
        <?php
        while ($row = $result_drf->fetch_assoc()) {
            echo "<tr>
                <td>{$row['customer_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>{$row['pan_number']}</td>
                <td>{$row['bank_details']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['certificate_number']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['number_of_shares']}</td>
                <td>{$row['drf_number']}</td>
                <td>{$row['branch']}</td>
            </tr>";
        }
        ?>
    </table>

    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
