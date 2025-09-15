<?php
include '../config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["error" => "You must be logged in to add items to the cart."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$menu_item_id = filter_input(INPUT_POST, 'menu_item_id', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);

if (!$menu_item_id || !$quantity) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input provided."]);
    exit;
}

// Check if the menu item exists
$query = "SELECT price FROM menu_items WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $menu_item_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Menu item not found."]);
    exit;
}

$row = $result->fetch_assoc();

// Add item to cart
$insert_query = "INSERT INTO cart (user_id, menu_item_id, quantity) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("iii", $user_id, $menu_item_id, $quantity);

if ($stmt->execute()) {
    echo json_encode(["success" => "Item added to cart successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to add item to cart."]);
}

$stmt->close();
$conn->close();
?>
