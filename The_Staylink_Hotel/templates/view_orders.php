<?php
// view_orders.php

include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Gallery Café</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h1>Your Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($order = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>' . $order['id'] . '</td>
                    <td>' . $order['order_time'] . '</td>
                    <td>' . $order['status'] . '</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
