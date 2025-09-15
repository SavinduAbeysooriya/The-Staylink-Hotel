<?php
session_start();
require_once '../config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    echo '<p class="error">User not logged in.</p>';
    exit;
}

$userId = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT id, table_number, reservation_time, status FROM reservations WHERE user_id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservations = $result->fetch_all(MYSQLI_ASSOC);

    if ($reservations) {
        echo '<table class="table table-striped"><thead><tr><th>Table Number</th><th>Reservation Time</th><th>Status</th><th>Action</th></tr></thead><tbody>';
        foreach ($reservations as $reservation) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($reservation['table_number']) . '</td>';
            echo '<td>' . htmlspecialchars($reservation['reservation_time']) . '</td>';
            echo '<td>' . htmlspecialchars($reservation['status']) . '</td>';
            echo '<td><button class="btn btn-danger btn-sm cancel-btn" data-id="' . $reservation['id'] . '">Cancel</button></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No reservations found.</p>';
    }
} catch (mysqli_sql_exception $e) {
    echo '<p class="error">Error fetching reservations: ' . $e->getMessage() . '</p>';
}
?>
