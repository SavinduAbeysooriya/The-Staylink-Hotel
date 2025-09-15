// processes/remove_from_cart.php
<?php
include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to remove items from the cart.";
    exit;
}

$cart_id = $_POST['cart_id'];

$query = "DELETE FROM cart WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();

echo "Item removed from cart successfully!";
?>
