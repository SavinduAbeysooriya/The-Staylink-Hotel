<?php
include '../config.php';

// Validate input
$table_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$table_id) {
    echo "Invalid table ID.";
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Delete reservations associated with the table
    $delete_reservations_sql = "DELETE FROM reservations WHERE table_number = (SELECT table_number FROM tables WHERE id = ?)";
    $stmt = $conn->prepare($delete_reservations_sql);
    $stmt->bind_param("i", $table_id);
    $stmt->execute();
    
    // Delete the table
    $delete_table_sql = "DELETE FROM tables WHERE id = ?";
    $stmt = $conn->prepare($delete_table_sql);
    $stmt->bind_param("i", $table_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();
    echo "Table deleted successfully.";
} catch (Exception $e) {
    // Rollback transaction if something failed
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
