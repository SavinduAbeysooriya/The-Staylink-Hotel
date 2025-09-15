<?php
include '../config.php';

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE categories SET name = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $name, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Category updated successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error updating category.']);
}
?>
