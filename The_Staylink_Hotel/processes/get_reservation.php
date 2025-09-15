<?php
include '../config.php';

$id = $_GET['id'];

$sql = "SELECT r.*, u.name as user_name, t.capacity FROM reservations r 
        JOIN users u ON r.user_id = u.id
        JOIN tables t ON r.table_number = t.table_number WHERE r.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();

echo json_encode($reservation);

$stmt->close();
$conn->close();
?>
