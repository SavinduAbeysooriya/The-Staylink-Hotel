<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

// Ensure user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$response = array('success' => false, 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Validate input
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required.';
    }
    if (empty($description)) {
        $response['errors']['description'] = 'Description is required.';
    }
    if (!is_numeric($price) || $price <= 0) {
        $response['errors']['price'] = 'Price must be a positive number.';
    }
    if (empty($category)) {
        $response['errors']['category'] = 'Category is required.';
    }
    
    // Handle image upload
    $image = $_FILES['image'];
    $targetDir = "../assets/images/";
    $targetFile = $targetDir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        $response['errors']['image'] = 'File is not an image.';
        $uploadOk = 0;
    }

    // Check file size
    if ($image["size"] > 500000) { // 500KB limit
        $response['errors']['image'] = 'Sorry, your file is too large.';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $response['errors']['image'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['message'] = 'Sorry, your file was not uploaded.';
    } else {
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            $imagePath = 'assets/images/' . basename($image["name"]);
            
            // Insert menu item into database
            $sql = "INSERT INTO menu_items (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdss", $name, $description, $price, $category, $imagePath);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Menu item added successfully!';
            } else {
                $response['message'] = 'Error: ' . $conn->error;
            }

            $stmt->close();
        } else {
            $response['message'] = 'Sorry, there was an error uploading your file.';
        }
    }

    echo json_encode($response);
}
?>
