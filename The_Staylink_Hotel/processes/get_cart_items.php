<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $itemIds = implode(',', array_keys($cartItems));
    $query = "SELECT * FROM menu_items WHERE id IN ($itemIds)";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $imagePath = '../assets/images/' . basename($row['image']);
            $imageUrl = file_exists($imagePath) ? 'assets/images/' . basename($row['image']) : 'assets/images/default.png';

            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card menu-card">';
            echo '<img src="' . $imageUrl . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
            echo '<p class="card-text"><strong>$' . number_format($row['price'], 2) . '</strong></p>';
            echo '<p class="card-text"><strong>Quantity: ' . $_SESSION['cart'][$row['id']] . '</strong></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">No items in cart.</p>';
    }
} else {
    echo '<p class="text-center">No items in cart.</p>';
}

mysqli_close($conn);
?>
