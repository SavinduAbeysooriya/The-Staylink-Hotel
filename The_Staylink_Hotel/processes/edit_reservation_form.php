<?php
session_start();
include '../config.php';

$id = $_POST['id'];
$user_name = $_POST['user_name'];
$table_number = $_POST['table_number'];
$reservation_time = $_POST['reservation_time'];
$status = $_POST['status'];

$query = "UPDATE reservations 
          SET user_id = (SELECT id FROM users WHERE name = ?), 
              table_number = ?, 
              reservation_time = ?, 
              status = ? 
          WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('sissi', $user_name, $table_number, $reservation_time, $status, $id);

if ($stmt->execute()) {
    echo 'Reservation updated successfully.';
} else {
    echo 'Error updating reservation.';
}
?>
