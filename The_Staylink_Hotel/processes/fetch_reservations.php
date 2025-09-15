<?php
include '../config.php';

// Fetch all reservations with user and table details
$sql = "SELECT r.*, u.name as user_name, t.capacity 
        FROM reservations r 
        JOIN users u ON r.user_id = u.id
        JOIN tables t ON r.table_number = t.table_number";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . htmlspecialchars($row['user_name']) . '</td>
            <td>' . htmlspecialchars($row['table_number']) . '</td>
            <td>' . htmlspecialchars($row['capacity']) . '</td>
            <td>' . htmlspecialchars($row['reservation_time']) . '</td>
            <td>' . htmlspecialchars($row['status']) . '</td>
            <td>
                <button class="btn btn-warning btn-sm editReservation" data-id="' . $row['id'] . '">Edit</button>
                <button class="btn btn-danger btn-sm deleteReservation" data-id="' . $row['id'] . '">Delete</button>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="6" class="text-center">No reservations found.</td></tr>';
}
$conn->close();
?>
