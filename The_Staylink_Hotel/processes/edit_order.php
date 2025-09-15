<?php
// Include database configuration
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['order_id']);
    $user_id = intval($_POST['user_id']);
    $total_price = floatval($_POST['total_price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "UPDATE orders SET user_id = ?, total_price = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'idsi', $user_id, $total_price, $status, $order_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Order updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
