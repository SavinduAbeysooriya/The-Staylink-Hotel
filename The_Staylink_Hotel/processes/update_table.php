<?php
// processes/update_table.php
include '../config.php';

// Validate and sanitize input
$table_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$table_number = filter_input(INPUT_POST, 'table_number', FILTER_VALIDATE_INT);
$capacity = filter_input(INPUT_POST, 'capacity', FILTER_VALIDATE_INT);

if (!$table_id || !$table_number || !$capacity) {
    echo "Invalid input. Please provide all required fields.";
    exit;
}

// Check if the table number already exists for a different table
$check_query = "SELECT * FROM tables WHERE table_number = ? AND id != ?";
$check_stmt = $conn->prepare($check_query);
$check_stmt->bind_param("ii", $table_number, $table_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    echo "Table number already exists.";
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
