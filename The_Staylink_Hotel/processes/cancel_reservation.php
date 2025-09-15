<?php
session_start();
require_once '../config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit;
    }

    $reservationId = intval($_POST['id']);
    $userId = $_SESSION['user_id'];

    if (empty($reservationId)) {
        echo json_encode(['success' => false, 'message' => 'Invalid reservation ID.']);
        exit;
    }

    try {
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
        $stmt->bind_param('ii', $reservationId, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Reservation cancelled.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Reservation not found or not owned by user.']);
        }
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
