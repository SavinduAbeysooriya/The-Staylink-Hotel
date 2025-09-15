<?php
require_once '../config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);

    if (empty($cart)) {
        echo json_encode(['status' => 'error', 'message' => 'Cart is empty.']);
        exit;
    }

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'You must be logged in to place an order.']);
        exit;
    }

    $userId = $_SESSION['user_id'];
    $conn->begin_transaction();

    try {
        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Insert order into orders table
        $orderQuery = "INSERT INTO orders (user_id, total) VALUES ('$userId', '$total')";
        $conn->query($orderQuery);
        $orderId = $conn->insert_id;

        // Insert each item into order_items table
        foreach ($cart as $item) {
            $menuItemId = $item['menu_item_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $orderItemQuery = "INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES ('$orderId', '$menuItemId', '$quantity', '$price')";
            $conn->query($orderItemQuery);
        }

        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Order placed successfully.']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Error processing order.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
