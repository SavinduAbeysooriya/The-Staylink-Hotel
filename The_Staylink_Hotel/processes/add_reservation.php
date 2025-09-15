<?php
include '../config.php';

$user_id = $_POST['user_name'];
$table_number = $_POST['table_number'];
$reservation_time = $_POST['reservation_time'];

$sql = "INSERT INTO reservations (user_id, table_number, reservation_time, status) VALUES (?, ?, ?, 'Pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iis', $user_id, $table_number, $reservation_time);

if ($stmt->execute()) {
    echo 'Reservation added successfully!';
} else {
    echo 'Error adding reservation: ' . $conn->error;
}
$stmt->close();
$conn->close();
?>
