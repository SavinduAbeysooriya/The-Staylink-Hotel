<?php
include '../config.php';

$name = $_POST['name'];

$sql = "INSERT INTO categories (name) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $name);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo 'Category added successfully';
} else {
    echo 'Error adding category';
}
?>
