<?php
session_start();
include '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to book a room.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$room_id = $_POST['room_id'];
$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];

// Validate dates
if (strtotime($check_in_date) >= strtotime($check_out_date)) {
    echo json_encode(['success' => false, 'message' => 'Check-out date must be after check-in date.']);
    exit;
}

// Validate if the room is available for the given dates
$stmt = $conn->prepare("SELECT * FROM room_bookings WHERE room_id = ? AND ((check_in_date BETWEEN ? AND ?) OR (check_out_date BETWEEN ? AND ?)) AND status = 'confirmed'");
$stmt->bind_param('issss', $room_id, $check_in_date, $check_out_date, $check_in_date, $check_out_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'This room is already booked for the selected dates.']);
    exit;
}

// Insert the booking into the database
$stmt = $conn->prepare("INSERT INTO room_bookings (user_id, room_id, check_in_date, check_out_date, status) VALUES (?, ?, ?, ?, 'pending')");
$stmt->bind_param('iiss', $user_id, $room_id, $check_in_date, $check_out_date);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $booking_id = $stmt->insert_id;
    echo json_encode(['success' => true, 'message' => 'Room booked successfully! Please proceed to payment.', 'booking_id' => $booking_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to book the room. Please try again.']);
}
?>
