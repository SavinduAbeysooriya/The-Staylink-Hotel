<?php
include '../config.php';

// Fetch all tables
$sql = "SELECT * FROM tables ORDER BY table_number ASC";
$result = $conn->query($sql);

$tables = [];
while ($row = $result->fetch_assoc()) {
    $tables[] = $row;
}

echo json_encode($tables);

$conn->close();
?>
