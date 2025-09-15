<?php
include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];
$car_id = $_POST['car_id'];
$rental_start_date = $_POST['rental_start_date'];
$rental_end_date = $_POST['rental_end_date'];

// Prevent overbooking: Check if the car is already booked during the requested period
$query = "SELECT id FROM car_rentals WHERE car_id = ? AND status = 'confirmed' AND (
              (rental_start_date BETWEEN ? AND ?) OR 
              (rental_end_date BETWEEN ? AND ?))";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $car_id, $rental_start_date, $rental_end_date, $rental_start_date, $rental_end_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'This car is already booked during the selected dates.']);
    exit;
}

// Get car price and model
$query = "SELECT price_per_day, car_model FROM cars WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();
$price_per_day = $car['price_per_day'];
$car_model = $car['car_model'];

$start_date = new DateTime($rental_start_date);
$end_date = new DateTime($rental_end_date);
$interval = $start_date->diff($end_date);
$total_days = $interval->days;
$total_price = $total_days * $price_per_day;

// Insert rental information into the database
$query = "INSERT INTO car_rentals (user_id, car_id, rental_start_date, rental_end_date, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("iissd", $user_id, $car_id, $rental_start_date, $rental_end_date, $total_price);
$stmt->execute();
$rental_id = $stmt->insert_id;  // Get the rental ID

// Update car availability status to 'rented'
$query = "UPDATE cars SET availability_status = 'rented' WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $car_id);
$stmt->execute();

// Send response with rental details
$response = [
    'success' => true,
    'message' => 'Rental created successfully.',
    'rental_id' => $rental_id,
    'car_model' => $car_model,
    'rental_start_date' => $rental_start_date,
    'rental_end_date' => $rental_end_date,
    'total_price' => $total_price
];

echo json_encode($response);
?>
