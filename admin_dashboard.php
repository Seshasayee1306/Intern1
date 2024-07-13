<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$sql = "SELECT c.*, cer.certificate_number, cer.company_name, cer.number_of_shares, cer.drf_number, cer.branch 
        FROM customers c 
        LEFT JOIN certificates cer ON c.customer_id = cer.customer_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div class="btn-container">
        <a href="view_branches.php" class="button">View Branches</a>
    </div>
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
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
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
                <td><a href='assign_branch.php?id={$row['customer_id']}'>Assign Branch</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
