<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$customer_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $branch = $_POST['branch'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin credentials for reconfirmation
    $admin_username = 'admin';
    $admin_password = 'Prabhabala##70';

    if ($username === $admin_username && $password === $admin_password) {
        // Fetch customer and certificate details
        $sql = "SELECT c.*, cer.certificate_number, cer.company_name, cer.number_of_shares, cer.drf_number 
                FROM customers c 
                LEFT JOIN certificates cer ON c.customer_id = cer.customer_id 
                WHERE c.customer_id='$customer_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($branch == 'demat') {
            $sql = "INSERT INTO demat (customer_id, certificate_number, company_name, number_of_shares, drf_number, branch) 
                    VALUES ('{$row['customer_id']}', '{$row['certificate_number']}', '{$row['company_name']}', '{$row['number_of_shares']}', '{$row['drf_number']}', 'demat')";
        } else {
            $sql = "INSERT INTO drf (customer_id, certificate_number, company_name, number_of_shares, drf_number, branch) 
                    VALUES ('{$row['customer_id']}', '{$row['certificate_number']}', '{$row['company_name']}', '{$row['number_of_shares']}', '{$row['drf_number']}', 'drf')";
        }

        if ($conn->query($sql) === TRUE) {
            // Update branch in certificates table
            $sql = "UPDATE certificates SET branch='$branch' WHERE customer_id='$customer_id'";
            $conn->query($sql);

            header("Location: view_branches.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error = "Invalid admin credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Branch</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="post" action="">
            <h2>Assign Branch</h2>
            <select name="branch" required>
                <option value="demat">Demat</option>
                <option value="drf">DRF</option>
            </select>
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Admin Password" required>
            <button type="submit">Assign</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
