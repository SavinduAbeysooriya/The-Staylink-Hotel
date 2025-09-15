<?php
include '../config.php';

// Validate and sanitize input
$table_number = filter_input(INPUT_POST, 'table_number', FILTER_VALIDATE_INT);
$capacity = filter_input(INPUT_POST, 'capacity', FILTER_VALIDATE_INT);

if (!$table_number || !$capacity) {
    echo "Invalid input. Please provide all required fields.";
    exit;
}

// Check if the table number already exists
$check_query = "SELECT * FROM tables WHERE table_number = ?";
$check_stmt = $conn->prepare($check_query);
$check_stmt->bind_param("i", $table_number);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    echo "Table number already exists.";
    exit;
}

// Insert table into the database
$sql = "INSERT INTO tables (table_number, capacity) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $table_number, $capacity);

if ($stmt->execute()) {
    echo "Table added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
