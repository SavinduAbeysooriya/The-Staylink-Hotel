<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_name'])) {
    $event_name = $_POST['event_name'];
    $user_id = $_SESSION['user_id'];

    // Insert booking into event_bookings
    $query = "INSERT INTO event_bookings (user_id, event_id, booking_status) VALUES (?, (SELECT id FROM events WHERE event_name = ?), 'confirmed')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $event_name);
    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Booking confirmed successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'There was an issue confirming your booking.'
        ];
    }

    echo json_encode($response);
}
?>
