<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    // Delete related cart entries for this user
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Get the order IDs for the user
        $sql = "SELECT id FROM orders WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Delete related order details for each order
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['id'];
            $sql = "DELETE FROM order_details WHERE order_id = ?";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("i", $order_id);
            $stmt2->execute();
            $stmt2->close();
        }

        // Now delete the orders for the user
        $sql = "DELETE FROM orders WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Delete reservations related to this user
            $sql = "DELETE FROM reservations WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Now delete the user
                $sql = "DELETE FROM users WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    echo "User, their cart entries, orders, order details, and reservations deleted successfully!";
                } else {
                    echo "Error deleting user: " . $conn->error;
                }
            } else {
                echo "Error deleting reservations: " . $conn->error;
            }
        } else {
            echo "Error deleting orders: " . $conn->error;
        }
    } else {
        echo "Error deleting cart entries: " . $conn->error;
    }

    $stmt->close();
}
?>
