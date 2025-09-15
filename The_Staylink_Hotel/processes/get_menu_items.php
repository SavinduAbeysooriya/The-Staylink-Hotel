<?php
include '../config.php';

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$sql = "SELECT * FROM menu_items";
if ($category_id > 0) {
    $sql .= " WHERE category_id = ?";
}
switch ($sort) {
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
        break;
}

$stmt = $conn->prepare($sql);
if ($category_id > 0) {
    $stmt->bind_param("i", $category_id);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageUrl = 'assets/images/' . basename($row['image']);
        echo '<div class="col-md-4" data-aos="fade-up">';
        echo '<div class="menu-item">';
        echo '<img src="' . $imageUrl . '" class="menu-image" alt="' . htmlspecialchars($row['name']) . '">';
        echo '<div>';
        echo '<h5 class="menu-title">' . htmlspecialchars($row['name']) . '</h5>';
        echo '<p class="menu-description">' . htmlspecialchars($row['description']) . '</p>';
        echo '<p class="menu-price">Rs. ' . number_format($row['price'], 2) . '</p>';
        echo '<input type="number" id="quantity-' . $row['id'] . '" class="form-control mb-2" min="1" value="1" style="width: 80px; display: inline-block;" />';
        echo '<button class="btn btn-primary btn-sm" onclick="validateAndAddToCart(' . $row['id'] . ')">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-light">No items available in this category.</p>';
}

$stmt->close();
$conn->close();
?>
