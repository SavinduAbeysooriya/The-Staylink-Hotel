<?php
include '../config.php';

// Validate input
$table_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$table_id) {
    echo json_encode(["error" => "Invalid table ID."]);
    exit;
}

// Fetch table details
$sql = "SELECT * FROM tables WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $table_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $table = $result->fetch_assoc();
    echo json_encode($table);
} else {
    echo json_encode(["error" => "Table not found."]);
}

$stmt->close();
$conn->close();
?>
