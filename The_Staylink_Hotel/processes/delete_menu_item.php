<?php
include '../config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Fetch the image path to delete the file from the server
        $stmt = $conn->prepare("SELECT image FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if ($item) {
            $imagePath = $item['image'];

            // Delete associated entries in the cart table
            $stmt = $conn->prepare("DELETE FROM cart WHERE menu_item_id = ?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting associated cart items.");
            }

            // Delete associated entries in the order_details table
            $stmt = $conn->prepare("DELETE FROM order_details WHERE menu_item_id = ?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting associated order details.");
            }

            // Now delete the menu item from the database
            $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                // Delete image file from server
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                echo "Menu item deleted successfully.";
            } else {
                throw new Exception("Error deleting menu item from database.");
            }
        } else {
            throw new Exception("Menu item not found.");
        }

        // Commit transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}
?>
