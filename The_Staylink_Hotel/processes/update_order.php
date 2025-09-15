<?php
include '../config.php';
header('Content-Type: application/json');

$order_id = $_POST['order_id'];
$user_id = $_POST['user_id'];
$total_price = $_POST['total_price'];
$status = $_POST['status'];

$query = "UPDATE orders SET user_id = ?, total_price = ?, status = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('idsi', $user_id, $total_price, $status, $order_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
