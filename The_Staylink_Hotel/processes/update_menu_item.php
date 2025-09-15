<?php
include '../config.php';

// Initialize the response array
$response = array('success' => false, 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $image = $_FILES['image']['name'];
    $target_dir = "../assets/images/";
    $imagePath = '';

    // Validate input
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required.';
    }
    if (empty($description)) {
        $response['errors']['description'] = 'Description is required.';
    }
    if ($price <= 0) {
        $response['errors']['price'] = 'Price must be a positive number.';
    }
    if (empty($category_id)) {
        $response['errors']['category'] = 'Category is required.';
    }

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $targetFile = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image
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

        // Allow only certain file formats
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
            } else {
                $response['errors']['image'] = 'Error uploading image.';
            }
        }
    }

    if (empty($response['errors'])) {
        // Prepare the SQL statement
        $sql = "UPDATE menu_items SET name = ?, description = ?, price = ?, category_id = ?" 
            . (!empty($imagePath) ? ", image = ?" : "") . " WHERE id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $response['message'] = 'SQL Error: ' . $conn->error;
        } else {
            if (!empty($imagePath)) {
                $stmt->bind_param("ssdssi", $name, $description, $price, $category_id, $imagePath, $id);
            } else {
                $stmt->bind_param("ssdsi", $name, $description, $price, $category_id, $id);
            }

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Menu item updated successfully.';
            } else {
                $response['message'] = 'Error updating menu item: ' . $stmt->error;
            }
            $stmt->close();
        }
    }

    // Set the header to application/json and output the response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
