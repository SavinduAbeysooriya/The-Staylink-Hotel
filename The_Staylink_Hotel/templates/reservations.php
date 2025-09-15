<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']); // Assuming 'user_id' in session means user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <!-- Bootstrap, AOS, jQuery, and Custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <style>
        /* New Distinctive Styles */
        body {
            background-color: #0f0f0f;
            color: #cfcfcf;
            font-family: 'Lora', serif;
            overflow-x: hidden;
            transition: background 0.5s ease;
        }

        #reservations h2, h3 {
            color: #d3b2d5;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        #reservations .card {
            background-color: rgba(20, 20, 20, 0.9);
            border: 1px solid #4c4c4c;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.7);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        #reservations .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 100, 150, 0.6);
        }

        #reservations .form-control {
            background-color: rgba(30, 30, 30, 0.9);
            border: 1px solid #6c6c6c;
            color: #e6e6e6;
        }

        .btn-primary {
            background: #ff6b6b;
            border: none;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.5);
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #ff4757;
            transform: translateY(-3px);
        }
        #reservationsList .table {
            background-color: rgba(25, 25, 25, 0.9);
            border-radius: 10px;
            color: #f5f5f5;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.7);
        }

        #reservations .alert-warning {
            background-color: #2c2c2c;
            border-color: #ffeeba;
            color: #ffd700;
        }

        #reservations textarea {
            background-color: rgba(30, 30, 30, 0.9);
            color: #fff;
            border: 1px solid #777;
        }

        /* AOS Transitions */
        [data-aos] {
            transition: transform 0.6s ease, opacity 0.6s ease;
        }

        #reservations .container {
            background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 50%, #292929 100%);
            max-width: 900px;
            margin: 0 auto;
            padding-top: 60px;
        }

        /* Unique for Reservations */
        .reservation-form {
            background-color: rgba(50, 50, 50, 0.9);
            border-radius: 15px;
            padding: 20px;
        }

        .reservation-form input, .reservation-form select {
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .reservation-form button {
            border-radius: 10px;
        }

    </style>
</head>
<body>
<section id="reservations" class="py-5">
    <div class="container">
        <div id="loginAlert" class="alert alert-warning d-none text-center" role="alert">
            <i class="fas fa-exclamation-circle"></i> You must be logged in to make a reservation.
        </div>

        <?php if ($isLoggedIn): ?>
            <h2 class="text-center mb-4" data-aos="fade-down">Make a Reservation</h2>
            <div class="reservation-form" data-aos="fade-up">
                <form id="reservationForm" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="table_number">Table Number:</label>
                            <select class="form-control" id="table_number" name="table_number" required>
                            </select>
                            <div class="invalid-feedback">Please select a valid table number.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="table_capacity">Table Capacity:</label>
                            <input type="text" class="form-control" id="table_capacity" name="table_capacity" readonly>
                            <div class="invalid-feedback">Table capacity information is required.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reservation_date">Reservation Date:</label>
                        <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
                        <div class="invalid-feedback">Please select a valid reservation date.</div>
                    </div>
                    <div class="form-group">
                        <label for="reservation_time">Reservation Time:</label>
                        <input type="time" class="form-control" id="reservation_time" name="reservation_time" required>
                        <div class="invalid-feedback">Please select a valid reservation time.</div>
                    </div>
                    <div class="form-group">
                        <label for="special_request">Special Request:</label>
                        <textarea class="form-control" id="special_request" name="special_request" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Reserve Now</button>
                </form>
            </div>

            <div class="mt-5">
                <h3 class="text-center mb-4" data-aos="fade-up">Current Reservations</h3>
                <div id="reservationsList" class="table-responsive">
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


<script>
    $(document).ready(function() {
        AOS.init(); // Initialize AOS for animations

        // Fetch available tables and existing reservations on page load
        fetchTables();
        fetchReservations();

        $('#reservationForm').on('submit', function(event) {
    event.preventDefault();

    // Check if user is logged in
    if (!<?php echo json_encode($isLoggedIn); ?>) {
        $('#loginAlert').removeClass('d-none').fadeIn().delay(5000).fadeOut();
        return;
    }

    // Client-side validation
    let form = this;
    if (form.checkValidity() === false) {
        event.stopPropagation();
        $(form).addClass('was-validated');
        return;
    }

    $.ajax({
        url: 'processes/process_reservation.php',
        type: 'POST',
        data: $(this).serialize(), // Serialize form data to send
        dataType: 'json',  // Ensures the response is expected to be in JSON format
        success: function(response) {
            console.log("Raw Response: ", response); // Log the raw response for debugging

            if (response.success) {
                alert('Reservation successful!');
                $('#reservationForm')[0].reset();
                $('#reservationForm').removeClass('was-validated');
                fetchReservations(); // Refresh the list of reservations
            } else {
                alert(response.message); // Show error message if reservation fails
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error, xhr.responseText); // Log any errors
            alert('Error making reservation.');
        }
    });
});



        // Function to fetch and display available tables
        function fetchTables() {
            $.ajax({
                url: 'processes/get_tables.php',
                type: 'GET',
                success: function(response) {
                    $('#table_number').html(response);
                    updateTableCapacity(); // Update capacity on page load
                },
                error: function() {
                    alert('Error fetching tables.');
                }
            });
        }

        // Function to update table capacity display
        function updateTableCapacity() {
            $('#table_number').change(function() {
                let selectedOption = $(this).find('option:selected');
                let capacity = selectedOption.data('capacity');
                $('#table_capacity').val(capacity ? capacity : '');
            }).trigger('change'); // Trigger change event to set initial capacity
        }

        // Function to fetch and display existing reservations
        function fetchReservations() {
            $.ajax({
                url: 'processes/get_reservations.php',
                type: 'GET',
                success: function(response) {
                    $('#reservationsList').html(response);
                    $('.table').addClass('animate__animated animate__fadeIn');
                },
                error: function() {
                    alert('Error fetching reservations.');
                }
            });
        }

        // Event delegation for cancel buttons
        $('#reservationsList').on('click', '.cancel-btn', function() {
            let reservationId = $(this).data('id');
            if (confirm('Are you sure you want to cancel this reservation?')) {
                $.ajax({
                    url: 'processes/cancel_reservation.php',
                    type: 'POST',
                    data: { id: reservationId },
                    success: function(response) {
                        let result = JSON.parse(response);
                        if (result.success) {
                            alert('Reservation cancelled.');
                            fetchReservations(); // Refresh the list of reservations
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function() {
                        alert('Error cancelling reservation.');
                    }
                });
            }
        });
    });
</script>
</body>
</html>
