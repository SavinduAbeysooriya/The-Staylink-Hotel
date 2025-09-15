<?php
session_start();
include '../config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to proceed with payment.']);
    exit();
}

// Ensure booking_id is provided
if (!isset($_POST['booking_id']) || empty($_POST['booking_id'])) {
    echo json_encode(['success' => false, 'message' => 'Booking ID is missing or invalid.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$booking_id = $_POST['booking_id']; // Comes from AJAX
$card_number = $_POST['card_number'];
$cvv = $_POST['cvv'];
$expiry_date = $_POST['expiry_date'];

// Basic validation for payment details
if (empty($card_number) || empty($cvv) || empty($expiry_date)) {
    echo json_encode(['success' => false, 'message' => 'Please provide valid card details.']);
    exit();
}

// Remove all spaces from card number
$card_number = preg_replace('/\s+/', '', $card_number);  // Remove spaces

// Additional Validations
if (strlen($card_number) != 16) {
    echo json_encode(['success' => false, 'message' => 'Card number must be 16 digits.']);
    exit();
}

if (strlen($cvv) != 3) {
    echo json_encode(['success' => false, 'message' => 'CVV must be 3 digits.']);
    exit();
}

$expiry_parts = explode('-', $expiry_date);
if (count($expiry_parts) != 2 || !checkdate($expiry_parts[1], 1, $expiry_parts[0])) {
    echo json_encode(['success' => false, 'message' => 'Expiry date is invalid. Use MM-YYYY format.']);
    exit();
}

// Simulate payment processing (for the sake of example)
$payment_success = true;

if ($payment_success) {
    // Update the booking status to 'confirmed'
    $sql = "UPDATE room_bookings SET status = 'confirmed' WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $booking_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Payment successful! Your booking is confirmed.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to confirm the booking. Please try again later.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Payment failed. Please try again.']);
}

?>
