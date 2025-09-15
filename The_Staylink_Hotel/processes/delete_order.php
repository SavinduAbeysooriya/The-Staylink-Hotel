<?php
include '../config.php';
header('Content-Type: application/json');

$order_id = $_POST['order_id'];

$query = "DELETE FROM orders WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $order_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
