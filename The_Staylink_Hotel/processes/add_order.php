<?php
include '../config.php';
header('Content-Type: application/json');

$user_id = $_POST['user_id'];
$total_price = $_POST['total_price'];
$status = $_POST['status'];

$query = "INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ids', $user_id, $total_price, $status);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
