<?php
session_start();
require_once 'config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to book a room.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$room_id = $_POST['room_id'];
$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];

// Check if the room is already booked for the selected dates
$sql = "SELECT * FROM room_bookings WHERE room_id = ? AND status = 'confirmed' 
        AND (check_in_date BETWEEN ? AND ? OR check_out_date BETWEEN ? AND ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('issss', $room_id, $check_in_date, $check_out_date, $check_in_date, $check_out_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'The room is already booked for the selected dates.']);
    exit();
}

// Proceed with booking the room
$sql = "INSERT INTO room_bookings (user_id, room_id, check_in_date, check_out_date, status) 
        VALUES (?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiss', $user_id, $room_id, $check_in_date, $check_out_date);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Room booked successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to book room. Please try again later.']);
}
?>
