<?php
include '../config.php';

// Validate input
$table_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$table_number = filter_input(INPUT_POST, 'table_number', FILTER_VALIDATE_INT);
$capacity = filter_input(INPUT_POST, 'capacity', FILTER_VALIDATE_INT);

if (!$table_id || !$table_number || !$capacity) {
    echo "Invalid input. Please provide all required fields.";
    exit;
}

// Update table in the database
$sql = "UPDATE tables SET table_number = ?, capacity = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $table_number, $capacity, $table_id);

if ($stmt->execute()) {
    echo "Table updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
