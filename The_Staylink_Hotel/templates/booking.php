<?php
include 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        

        .container1 {
            max-width: 100%;
            background: url('assets/images/room_booking.jpg') no-repeat center center/cover; /* Add your background image here */
            margin-top: 50px;
            padding: 20px;
        }

        h2 {
            font-weight: 600;
            color: #333;
        }

        /* Layout */
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-column {
            flex: 1;
            margin-right: 30px;
        }

        .flyer-column {
            flex: 1;
            margin-left: 30px;
            text-align: center;
        }

        /* Form Styles */
        .booking-form,
        .payment-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            padding: 15px;
            font-size: 1rem;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #5C6BC0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.3);
        }

        /* Flyer Styles */
        .flyer-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .flyer-image:hover {
            transform: scale(1.05);
        }

        /* Buttons */
        .btn-custom {
            width: 100%;
            padding: 12px 20px;
            font-size: 1.1rem;
            background-color: #5C6BC0;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #3f4d9f;
            cursor: pointer;
        }

        /* Alert Styles */
        .alert {
            font-weight: 600;
            text-align: center;
        }

        .alert-warning {
            background-color: #f39c12;
            color: #fff;
        }

        /* Card Styling */
        .booking-card {
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .booking-card-header {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            background-color: #28a745;
            color: #fff;
            font-size: 12px;
        }

        .status-warning {
            background-color: #f39c12;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .form-column,
            .flyer-column {
                flex: 1 1 100%;
                margin-right: 0;
                margin-left: 0;
            }

            .form-control,
            .btn-custom {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container1">
    <h2 class="text-center">Room Booking</h2>

    <?php if (!$isLoggedIn): ?>
        <div class="alert alert-warning">You must be logged in to book a room.</div>
    <?php else: ?>
        <div class="row">
            <!-- Booking Form Column -->
            <div class="form-column">
                <form id="bookingForm" class="booking-form">
                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select class="form-control" id="room_id" name="room_id" required>
                            <option value="">Select Room</option>
                            <?php
                            // Fetch rooms from the database
                            $roomsQuery = "SELECT * FROM rooms";
                            $roomsResult = $conn->query($roomsQuery);
                            if ($roomsResult->num_rows > 0) {
                                // Loop through and display rooms
                                while ($room = $roomsResult->fetch_assoc()) {
                                    echo "<option value='{$room['id']}'>{$room['room_number']} - {$room['type']} - \Rs {$room['price_per_night']}</option>";
                                }
                            } else {
                                echo "<option value=''>No rooms available</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="check_in_date">Check-in Date</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
                    </div>

                    <div class="form-group">
                        <label for="check_out_date">Check-out Date</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
                    </div>

                    <button type="submit" class="btn-custom">Book Room</button>
                </form>

                <!-- Payment Section -->
                <div id="paymentSection" style="display: none;">
                    <h3>Payment Details</h3>
                    <form id="paymentForm" class="payment-form">
                        <input type="hidden" id="booking_id" name="booking_id" value="">

                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" required>
                        </div>

                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required maxlength="3">
                        </div>

                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
                        </div>

                        <button type="submit" class="btn-custom">Make Payment</button>
                    </form>
                </div>
            </div>

            <!-- Flyer Image Column -->
            <div class="flyer-column">
                <img src="assets/images/rooms.jpg" alt="Promotional Flyer" class="flyer-image">
            </div>
        </div>

        <!-- Booking History -->
        <h3>Your Bookings</h3>
        <div id="bookingHistory"></div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle room booking form submission
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'processes/process_booking.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                let result = JSON.parse(response);
                Swal.fire({
                    title: result.success ? 'Booking Successful' : 'Booking Failed',
                    text: result.message,
                    icon: result.success ? 'success' : 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    if (result.success) {
                        $('#paymentSection').show();
                        $('#booking_id').val(result.booking_id); // Set booking_id dynamically
                    }
                });
            }
        });
    });

    // Handle payment form submission
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        let card_number = $('#card_number').val().replace(/\s/g, '');
        let cvv = $('#cvv').val();
        let expiry_date = $('#expiry_date').val();

        if (card_number.length !== 16 || cvv.length !== 3 || !expiry_date) {
            Swal.fire('Invalid Details', 'Please check your card details and try again.', 'error');
            return;
        }

        $.ajax({
            url: 'processes/process_payment.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                let result = JSON.parse(response);
                Swal.fire({
                    title: result.success ? 'Payment Successful' : 'Payment Failed',
                    text: result.message,
                    icon: result.success ? 'success' : 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

   // Fetch booking history on page load
   $.ajax({
        url: 'processes/get_booking_history.php',
        method: 'GET',
        success: function(response) {
            let result = JSON.parse(response);
            let historyHTML = result.length > 0 ? `
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Check-in Date</th>
                            <th>Check-out Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${result.map(booking => `
                            <tr>
                                <td>${booking.room_number}</td>
                                <td>${booking.check_in_date}</td>
                                <td>${booking.check_out_date}</td>
                                <td><span class="status-badge ${booking.status === 'confirmed' ? '' : 'status-warning'}">${booking.status}</span></td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>` : '<p>No bookings found.</p>';

            $('#bookingHistory').html(historyHTML);
        }
    });
});

</script>

</body>
</html>
