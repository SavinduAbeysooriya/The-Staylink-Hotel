<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php';

$selectedSlot = intval($_GET['time_slot']);
$slotQuery = $conn->prepare("SELECT start_time, end_time FROM time_slots WHERE id = ?");
$slotQuery->bind_param('i', $selectedSlot);
$slotQuery->execute();
$slotResult = $slotQuery->get_result();
$slot = $slotResult->fetch_assoc();

$startTime = date('Y-m-d') . ' ' . $slot['start_time'];
$endTime = date('Y-m-d') . ' ' . $slot['end_time'];

$query = "SELECT t.id, t.table_number, t.capacity 
          FROM tables t
          WHERE NOT EXISTS (
              SELECT 1 
              FROM reservations r 
              WHERE r.table_id = t.id 
              AND r.start_time < ? 
              AND r.end_time > ? 
              AND r.status = 'confirmed'
          )";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $endTime, $startTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<option value=''>Select a Table</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['table_number'] . " (Capacity: " . $row['capacity'] . ")</option>";
    }
} else {
    echo "<option value=''>No available tables</option>";
}
?>
