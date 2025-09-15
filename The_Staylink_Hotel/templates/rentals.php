<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        /* Unique Styling to avoid conflicts with other templates */
        .car-rental-container {
            background-image: linear-gradient(to top, #fff1eb 0%, #ace0f9 100%);
            font-family: 'Poppins', sans-serif;
            margin-top: 30px;
        }
        .car-rental-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        /* Car Card Grid Layout */
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        .car-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }
        .car-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }
        .car-card-body {
            padding: 20px;
            text-align: center;
        }
        .car-card-body p {
            margin: 10px 0;
        }

        /* Rental Details */
        .rental-details {
            display: none;
            margin-top: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .rental-details h3 {
            margin-bottom: 20px;
        }
        .rental-details p {
            margin-bottom: 10px;
        }

        /* Rental History Table */
        .rental-history-table {
            margin-top: 40px;
        }
        .rental-history-table th, .rental-history-table td {
            text-align: center;
            padding: 10px;
        }
        .rental-history-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .rental-history-table th {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container car-rental-container">
        <h2 class="car-rental-title" data-aos="fade-up">Car Rental</h2>

        <div class="row">
            <div class="col-12">
                <form id="rentalForm" class="booking-form">
                    <div class="form-group">
                        <label for="car_id">Car Model</label>
                        <select class="form-control" id="car_id" name="car_id" required>
                            <option value="">Select Car</option>
                            <?php
                            $carsQuery = "SELECT * FROM cars WHERE availability_status = 'available'";
                            $carsResult = $conn->query($carsQuery);
                            while ($car = $carsResult->fetch_assoc()) {
                                echo "<option value='{$car['id']}'>{$car['car_model']} - Rs {$car['price_per_day']} per day</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rental_start_date">Rental Start Date</label>
                        <input type="date" class="form-control" id="rental_start_date" name="rental_start_date" required>
                    </div>

                    <div class="form-group">
                        <label for="rental_end_date">Rental End Date</label>
                        <input type="date" class="form-control" id="rental_end_date" name="rental_end_date" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Book Car</button>
                </form>

                <!-- Rental details display after booking -->
                <div id="rentalDetails" class="rental-details">
                    <h3>Rental Details</h3>
                    <p><strong>Car Model:</strong> <span id="rentalCarModel"></span></p>
                    <p><strong>Rental Start Date:</strong> <span id="rentalStartDate"></span></p>
                    <p><strong>Rental End Date:</strong> <span id="rentalEndDate"></span></p>
                    <p><strong>Total Price:</strong> Rs <span id="totalPrice"></span></p>
                </div>
            </div>
        </div>

        <!-- Car Grid -->
        <div class="car-grid" data-aos="fade-up">
            <?php
            $carsQuery = "SELECT * FROM cars WHERE availability_status = 'available'";
            $carsResult = $conn->query($carsQuery);
            while ($car = $carsResult->fetch_assoc()) {
                $imagePath = 'assets/images/' . basename($car['image_path']);
                echo "<div class='car-card' data-aos='flip-left'>";
                echo "<img src='{$imagePath}' alt='{$car['car_model']}' class='car-image'>";
                echo "<div class='car-card-body'>";
                echo "<p><strong>{$car['car_model']}</strong></p>";
                echo "<p>Rs {$car['price_per_day']} per day</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <!-- Rental History Table -->
        <div class="rental-history-table">
            <h3>Your Rental History</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Car Model</th>
                        <th>Rental Start Date</th>
                        <th>Rental End Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $historyQuery = "SELECT * FROM car_rentals WHERE user_id = ? ORDER BY rental_start_date DESC";
                    $stmt = $conn->prepare($historyQuery);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $historyResult = $stmt->get_result();
                    while ($rental = $historyResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$rental['car_id']}</td>";
                        echo "<td>{$rental['rental_start_date']}</td>";
                        echo "<td>{$rental['rental_end_date']}</td>";
                        echo "<td>Rs {$rental['total_price']}</td>";
                        echo "<td>{$rental['status']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init();

        $(document).ready(function () {
            // Handle car rental form submission
            $('#rentalForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting traditionally

                $.ajax({
                    url: 'processes/process_rental.php',  // Send the form data to the backend
                    method: 'POST',
                    data: $(this).serialize(),  // Serialize form data
                    success: function (response) {
                        let result = JSON.parse(response);
                        Swal.fire({
                            title: result.success ? 'Rental Successful' : 'Rental Failed',
                            text: result.message,
                            icon: result.success ? 'success' : 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            if (result.success) {
                                // Display rental details
                                $('#rentalDetails').show();
                                $('#rentalCarModel').text(result.car_model);
                                $('#rentalStartDate').text(result.rental_start_date);
                                $('#rentalEndDate').text(result.rental_end_date);
                                $('#totalPrice').text(result.total_price);
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: ", error);
                        Swal.fire('Error', 'Something went wrong. Please try again later.', 'error');
                    }
                });
            });
        });
    </script>

</body>
</html>
