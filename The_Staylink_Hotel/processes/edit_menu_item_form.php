<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

// Ensure the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Check if 'id' is passed in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch menu item data
    $sql = "SELECT * FROM menu_items WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        // Fetch all categories for dropdown
        $categoryQuery = "SELECT id, name FROM categories";
        $categoryResult = $conn->query($categoryQuery);

        if ($item): ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Menu Item</title>
                <!-- Bootstrap 5 -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
                <!-- Custom Styles -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
                <style>
                    body {
                        font-family: 'Poppins', sans-serif;
                        background-color: #1a1a1a;
                        color: #e0e0e0;
                    }

                    .container {
                        padding: 2rem;
                    }

                    .form-control, .form-select {
                        border-radius: 10px;
                        transition: 0.3s ease-in-out;
                        background-color: #2c2c2c;
                        color: #fff;
                        border: 1px solid #444;
                    }

                    .form-control:focus, .form-select:focus {
                        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                        border-color: #007bff;
                        background-color: #333;
                    }

                    .card {
                        border-radius: 15px;
                        overflow: hidden;
                        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.5);
                        background-color: #222;
                    }

                    .card-header {
                        background-color: #007bff;
                        color: #fff;
                        font-size: 1.5rem;
                        padding: 1rem;
                    }

                    .btn-primary, .btn-warning, .btn-danger {
                        border-radius: 5px;
                        transition: all 0.3s ease-in-out;
                    }

                    .btn-primary {
                        background-color: #007bff;
                        border: none;
                    }
                    
                    .btn-primary:hover {
                        background-color: #0056b3;
                    }

                    .btn-warning {
                        background-color: #d4a017;
                        border: none;
                    }

                    .btn-warning:hover {
                        background-color: #c49715;
                    }

                    .btn-danger {
                        background-color: #d9534f;
                        border: none;
                    }

                    .btn-danger:hover {
                        background-color: #c9302c;
                    }

                    .form-group label {
                        font-weight: 600;
                    }

                    .form-group img {
                        border-radius: 10px;
                    }

                    /* Animations */
                    .animate__animated {
                        animation-duration: 0.8s;
                    }
                </style>
            </head>
            <body>
            <div class="container animate__animated animate__fadeIn">
                <div class="card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        Edit Menu Item
                    </div>
                    <div class="card-body">
                        <form id="editMenuForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']); ?>">
                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($item['name']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($item['description']); ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price:</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($item['price']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="category">Category:</label>
                                <select class="form-select" id="category" name="category_id" required>
                                    <?php while ($category = $categoryResult->fetch_assoc()): ?>
                                        <option value="<?= htmlspecialchars($category['id']); ?>"
                                            <?= $item['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= htmlspecialchars($item['image']); ?>" alt="Menu Item Image" width="100" class="mt-2">
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Menu Item</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
            <script>
                $('#editMenuForm').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: 'processes/update_menu_item.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log('Raw Response:', response); // Debugging line
                            try {
                                // Directly use the response as JSON
                                var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                                if (jsonResponse.success) {
                                    alert(jsonResponse.message);
                                    location.reload();
                                } else {
                                    alert('Error: ' + jsonResponse.message);
                                    if (jsonResponse.errors) {
                                        for (var key in jsonResponse.errors) {
                                            if (jsonResponse.errors.hasOwnProperty(key)) {
                                                alert(jsonResponse.errors[key]);
                                            }
                                        }
                                    }
                                }
                            } catch (e) {
                                console.error('Error parsing JSON:', e);
                                alert('An error occurred while processing the response.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response Text:', xhr.responseText); // Debugging line
                            alert('Error updating menu item.');
                        }
                    });
                });
            </script>
            </body>
            </html>
        <?php endif;
        $stmt->close();
    }
}
?>
