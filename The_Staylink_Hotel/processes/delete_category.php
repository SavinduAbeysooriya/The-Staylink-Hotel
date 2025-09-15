<?php
include '../config.php';

$id = $_POST['id'];

$check_sql = "SELECT COUNT(*) as count FROM menu_items WHERE category_id = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    echo 'Cannot delete category with associated menu items.';
} else {
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Category deleted successfully';
    } else {
        echo 'Error deleting category';
    }
}
?>
