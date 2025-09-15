<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        /* Enhanced Event Container */
        .event-container {
            background-image: linear-gradient(to top, #f9f9f9, #e6f7ff);
            font-family: 'Poppins', sans-serif;
            padding-top: 50px;
            max-width: 100%;
            padding-bottom: 50px;
        }

        .event-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 40px;
            font-size: 2.5rem;
            color: #2C3E50;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.1);
        }

        /* Event Card Grid Layout */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .event-card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
            position: relative;
        }

        .event-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .event-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }

        .event-card-body {
            padding: 20px;
            text-align: center;
            background: #f9f9f9;
            border-radius: 0 0 15px 15px;
        }

        .event-card-body p {
            margin: 10px 0;
            color: #5f6368;
        }

        .btn-book-now {
            background-color: #1abc9c;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }

        .btn-book-now:hover {
            background-color: #16a085;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-book-now:focus {
            outline: none;
        }

        /* Status Badge Styles */
        .badge-pending {
            background-color: #f39c12;
            color: white;
        }

        .badge-confirmed {
            background-color: #28a745;
            color: white;
        }

        .badge-cancelled {
            background-color: #dc3545;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .event-title {
                font-size: 2rem;
            }

            .event-card-body {
                padding: 15px;
            }
        }

        /* Mint Color Accent */
        .mint-button {
            background-color: #2ecc71;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 30px;
            padding: 10px 25px;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .mint-button:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="event-title" data-aos="fade-up">Upcoming Events</h2>

        <!-- Event Grid -->
        <div class="event-grid" data-aos="fade-up">
            <?php
            // Database connection
            include 'config.php';
            
            // Fetch events from database
            $eventsQuery = "SELECT * FROM events WHERE event_status = 'confirmed' AND event_date >= CURDATE()";
            $eventsResult = $conn->query($eventsQuery);

            while ($event = $eventsResult->fetch_assoc()) {
                $imagePath = 'assets/images/' . basename($event['event_image']);
                echo "<div class='event-card' data-aos='flip-left'>";
                echo "<img src='{$imagePath}' alt='{$event['event_name']}' class='event-image'>";
                echo "<div class='event-card-body'>";
                echo "<h5><strong>{$event['event_name']}</strong></h5>";
                echo "<p>{$event['event_type']}</p>";
                echo "<p><strong>Date:</strong> {$event['event_date']}</p>";
                echo "<p><strong>Location:</strong> {$event['event_location']}</p>";
                echo "<p><strong>Total Price:</strong> Rs {$event['total_price']}</p>";
                echo "<button class='btn-book-now mint-button book-now' data-id='{$event['id']}'>Register Now</button>";
                echo "</div></div>";
            }
            ?>
        </div>
    </div>

    <!-- Event Booking Details -->
    <div id="eventBookingDetails" class="event-details" style="display:none;">
        <h3>Booking Details</h3>
        <p><strong>Event Name:</strong> <span id="eventName"></span></p>
        <p><strong>Event Date:</strong> <span id="eventDate"></span></p>
        <p><strong>Location:</strong> <span id="eventLocation"></span></p>
        <p><strong>Total Price:</strong> Rs <span id="eventPrice"></span></p>
    </div>

    <!-- User's Event Booking History -->
    <div class="container mt-5">
        <h3>Your Event Bookings</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch user event bookings
                $user_id = $_SESSION['user_id'];
                $bookingQuery = "SELECT events.event_name, events.event_date, event_bookings.booking_status
                                 FROM event_bookings 
                                 INNER JOIN events ON event_bookings.event_id = events.id
                                 WHERE event_bookings.user_id = ?";
                $stmt = $conn->prepare($bookingQuery);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($booking = $result->fetch_assoc()) {
                    $statusBadge = '';
                    if ($booking['booking_status'] == 'pending') {
                        $statusBadge = "<span class='badge badge-pending'>Pending</span>";
                    } elseif ($booking['booking_status'] == 'confirmed') {
                        $statusBadge = "<span class='badge badge-confirmed'>Confirmed</span>";
                    } else {
                        $statusBadge = "<span class='badge badge-cancelled'>Cancelled</span>";
                    }
                    echo "<tr>";
                    echo "<td>{$booking['event_name']}</td>";
                    echo "<td>{$booking['event_date']}</td>";
                    echo "<td>{$statusBadge}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init();

        $(document).ready(function () {
            // Handle event registration
            $('.book-now').on('click', function () {
                let event_id = $(this).data('id');
                
                $.ajax({
                    url: 'processes/process_event_booking.php',
                    method: 'POST',
                    data: { event_id: event_id },
                    success: function(response) {
                        let result = JSON.parse(response);
                        Swal.fire({
                            title: result.success ? 'Booking Successful' : 'Booking Failed',
                            text: result.message,
                            icon: result.success ? 'success' : 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            if (result.success) {
                                // Display booking details
                                $('#eventBookingDetails').show();
                                $('#eventName').text(result.event_name);
                                $('#eventDate').text(result.event_date);
                                $('#eventLocation').text(result.event_location);
                                $('#eventPrice').text(result.total_price);
                            }
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Something went wrong. Please try again later.', 'error');
                    }
                });
            });
        });
    </script>

</body>
</html>
