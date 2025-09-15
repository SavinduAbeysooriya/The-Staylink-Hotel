<?php
include '../config.php';

header('Content-Type: application/json');

$query = "SELECT DISTINCT * FROM categories"; // Use DISTINCT to avoid duplicate rows
$result = mysqli_query($conn, $query);

$categories = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}

echo json_encode($categories);
mysqli_close($conn);
?>
