<?php
session_start();
require_once '../config.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to view your bookings.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to get booking history for the logged-in user
$sql = "SELECT rb.id, r.room_number, rb.check_in_date, rb.check_out_date, rb.status 
        FROM room_bookings rb
        JOIN rooms r ON rb.room_id = r.id
        WHERE rb.user_id = ? ORDER BY rb.check_in_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    echo json_encode($bookings); // Return the list of bookings as JSON
} else {
    echo json_encode([]); // If no bookings found
}
?>
