<?php
include '../config.php'; // Include your database connection

$query = "SELECT t.table_number, t.capacity FROM tables t";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<option value='' data-capacity=''>Select a table</option>"; // Placeholder option
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['table_number'] . "' data-capacity='" . $row['capacity'] . "'>" . $row['table_number'] . "</option>";
    }
} else {
    echo "<option value=''>No tables available</option>";
}

mysqli_close($conn);
?>
