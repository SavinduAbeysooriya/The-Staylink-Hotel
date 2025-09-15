<?php
include '../config.php';

$id = $_POST['id'];
$user_id = $_POST['user_name'];
$table_number = $_POST['table_number'];
$reservation_time = $_POST['reservation_time'];
$status = $_POST['status'];

$sql = "UPDATE reservations SET user_id = ?, table_number = ?, reservation_time = ?, status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iisss', $user_id, $table_number, $reservation_time, $status, $id);

if ($stmt->execute()) {
    echo 'Reservation updated successfully!';
} else {
    echo 'Error updating reservation: ' . $conn->error;
}
$stmt->close();
$conn->close();
?>
