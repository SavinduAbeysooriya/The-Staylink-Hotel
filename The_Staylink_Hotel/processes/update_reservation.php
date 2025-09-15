<?php
// processes/update_reservation.php
include '../config.php';

// Validate and sanitize input
$reservation_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$table_number = filter_input(INPUT_POST, 'table_number', FILTER_VALIDATE_INT);
$reservation_time = filter_input(INPUT_POST, 'reservation_time', FILTER_SANITIZE_STRING);

if (!$reservation_id || !$table_number || !$reservation_time) {
    echo "Invalid input. Please provide all required fields.";
    exit;
}

// Check if the table is available at the requested time
$check_query = "SELECT * FROM reservations WHERE table_number = ? AND reservation_time = ? AND id != ?";
$check_stmt = $conn->prepare($check_query);
$check_stmt->bind_param("isi", $table_number, $reservation_time, $reservation_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    echo "The selected table is already reserved at this time.";
    exit;
}

// Update reservation in the database
$sql = "UPDATE reservations SET table_number = ?, reservation_time = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $table_number, $reservation_time, $reservation_id);

if ($stmt->execute()) {
    echo "Reservation updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
