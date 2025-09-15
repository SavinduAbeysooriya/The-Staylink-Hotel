<?php
include '../config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login first.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$room_id = $_POST['room_id'];
$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];

// Check if the room is already booked in the given date range
$query = "SELECT * FROM room_bookings WHERE room_id = ? AND status = 'confirmed' 
          AND ((check_in_date BETWEEN ? AND ?) OR (check_out_date BETWEEN ? AND ?))";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $room_id, $check_in_date, $check_out_date, $check_in_date, $check_out_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Room is already booked for the selected dates.']);
    exit();
}

// Proceed with room booking
$query = "INSERT INTO room_bookings (user_id, room_id, check_in_date, check_out_date, status) 
          VALUES (?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiss", $user_id, $room_id, $check_in_date, $check_out_date);
if ($stmt->execute()) {
    // Fetch the total price for the booking
    $price_query = "SELECT price_per_night FROM rooms WHERE id = ?";
    $price_stmt = $conn->prepare($price_query);
    $price_stmt->bind_param("i", $room_id);
    $price_stmt->execute();
    $price_result = $price_stmt->get_result();
    $price = $price_result->fetch_assoc()['price_per_night'];

    // Calculate the total price (number of nights * price per night)
    $check_in = new DateTime($check_in_date);
    $check_out = new DateTime($check_out_date);
    $nights = $check_in->diff($check_out)->days;
    $total_price = $nights * $price;

    echo json_encode(['status' => 'success', 'message' => 'Booking successfully placed!', 'total_price' => $total_price]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to place the booking. Please try again.']);
}
?>
