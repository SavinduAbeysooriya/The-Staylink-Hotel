<?php
include '../config.php';

$id = $_POST['id'];

$sql = "DELETE FROM reservations WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo 'Reservation deleted successfully!';
} else {
    echo 'Error deleting reservation: ' . $conn->error;
}
$stmt->close();
$conn->close();
?>
