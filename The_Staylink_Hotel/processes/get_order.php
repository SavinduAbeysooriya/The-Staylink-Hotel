<?php
// Include database configuration
include('../config.php');

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $query = "
        SELECT o.id AS id, o.user_id, o.total_price, o.status
        FROM orders o
        WHERE o.id = $order_id
    ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else {
        echo json_encode(['error' => 'Error fetching order details.']);
    }
} else {
    echo json_encode(['error' => 'Order ID not specified.']);
}
?>
