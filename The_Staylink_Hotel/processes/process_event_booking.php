<?php
// Database connection
include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

// Check if user already booked the event
$query = "SELECT * FROM event_bookings WHERE user_id = ? AND event_id = ? AND booking_status = 'confirmed'";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User has already booked this event
    $response = [
        'success' => false,
        'message' => 'You have already booked this event.'
    ];
    echo json_encode($response);
    exit;
}

// Check if the event exists and its status
$query = "SELECT * FROM events WHERE id = ? AND event_status = 'confirmed' AND event_date >= CURDATE()";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if ($event) {
    // Proceed with booking the event
    $query = "INSERT INTO event_bookings (user_id, event_id, booking_status) VALUES (?, ?, 'confirmed')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();

    $response = [
        'success' => true,
        'message' => 'Your booking has been placed successfully!',
        'event_name' => $event['event_name'],
        'event_date' => $event['event_date'],
        'event_location' => $event['event_location'],
        'total_price' => $event['total_price']
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Event not found or is not available for booking.'
    ];
}

echo json_encode($response);
?>
