<?php
include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];
$rental_id = $_POST['rental_id'];
$card_number = $_POST['card_number'];
$cvv = $_POST['cvv'];
$expiry_date = $_POST['expiry_date'];
$amount = $_POST['amount'];

// Hash sensitive data before saving
$hashed_card_number = password_hash($card_number, PASSWORD_DEFAULT);
$hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);

// Insert payment info into the database
$query = "INSERT INTO payments (user_id, amount, payment_method, payment_status, card_number, cvv, expiry_date) VALUES (?, ?, 'credit_card', 'completed', ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("idsss", $user_id, $amount, $hashed_card_number, $hashed_cvv, $expiry_date);
$stmt->execute();

// Update rental status to 'confirmed'
$query = "UPDATE car_rentals SET status = 'confirmed' WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $rental_id);
$stmt->execute();

// Send response with success message
$response = [
    'success' => true,
    'message' => 'Payment completed successfully. Your rental is confirmed.'
];

echo json_encode($response);
?>
