<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewId = $_POST['review_id'];

    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $reviewId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Review deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting review.']);
    }

    $stmt->close();
    $conn->close();
}
?>
