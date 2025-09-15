<?php
include('../config.php');

if (isset($_POST['order_id'], $_POST['status'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $valid_statuses = ['Pending', 'Processing', 'Completed', 'Cancelled'];
    if (!in_array($status, $valid_statuses)) {
        echo "Invalid status.";
        exit();
    }

    $query = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";
    if (mysqli_query($conn, $query)) {
        echo "Order status updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Required fields are missing.";
}

mysqli_close($conn);
