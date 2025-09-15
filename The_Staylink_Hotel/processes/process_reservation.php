<?php
session_start();
include '../config.php'; // Ensure the database connection is included

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit;
    }

    $userId = $_SESSION['user_id'];
    $tableNumber = intval($_POST['table_number']);
    $reservationDate = $_POST['reservation_date'];
    $reservationTime = $_POST['reservation_time'];
    $specialRequest = trim($_POST['special_request']);

    // Validate the input fields
    if (empty($tableNumber) || empty($reservationDate) || empty($reservationTime)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    try {
        // Prepare the SQL query to insert reservation
        $stmt = $conn->prepare("INSERT INTO reservations (user_id, table_number, reservation_time, special_request, status) VALUES (?, ?, ?, ?, 'pending')");
        $fullReservationDateTime = $reservationDate . ' ' . $reservationTime; // Combine date and time
        $stmt->bind_param('iiss', $userId, $tableNumber, $fullReservationDateTime, $specialRequest);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Reservation added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add reservation.']);
        }

        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        // Catch and return any SQL errors as a JSON response
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
