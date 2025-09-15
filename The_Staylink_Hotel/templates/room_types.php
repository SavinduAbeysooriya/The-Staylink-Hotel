<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Types</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        /* Room Types Section Styling */
        .room-types-container {
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('assets/images/BG1.jpg') no-repeat center center/cover; /* Add your background image here */
            margin: 0;
            width: 100%;
            margin-bottom: 50px;
        }

        .room-types-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 2.5rem;
            color: #333;
            padding-top: 40px;
            width: 100%;
        }

        /* Subtitle under the main title */
        .room-types-subtitle {
            text-align: center;
            font-size: 1.25rem;
            color: #555;
            padding: 10px 30px;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* Carousel Custom Styling */
        .carousel-inner .carousel-item img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item:hover img {
            transform: scale(1.05);
        }

        .carousel-caption {
            position: absolute;
            bottom: 30px;
            left: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            width: 60%;
            opacity: 0;
            animation: slideIn 1s forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                bottom: 0;
            }
            100% {
                opacity: 1;
                bottom: 30px;
            }
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #1abc9c;
        }

        .btn-learn-more {
            background-color: #1abc9c;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-learn-more:hover {
            background-color: #16a085;
            transform: scale(1.05);
        }

        /* Carousel Styling - Centering and Width */
        .carousel {
            width: 90%;
            margin: 0 auto; /* Center the carousel */
        }

        .carousel-item {
            width: 100%;
        }

        /* Remove container margins */
        .container {
            padding-left: 0;
            padding-right: 0;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .room-types-title {
                font-size: 2rem;
            }

            .carousel-caption {
                width: 80%;
            }

            .room-types-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid room-types-container">
        <h2 class="room-types-title" data-aos="fade-up">Recommended Room Types</h2>

        <!-- Subtitle Section -->
        <p class="room-types-subtitle" data-aos="fade-up" data-aos-delay="500">
            With the largest room inventory in the city, Staylink offers various types of classic rooms and suites appointed with modern amenities. Designed to be a peaceful retreat for travellers near and far, discover your Staylink to the moments and recharge yourself for new possibilities.
        </p>

        <!-- Carousel Section for Room Types -->
        <div id="roomCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">

                <!-- Room 1 -->
                <div class="carousel-item active">
                    <img src="assets/images/room1.jpg" alt="Luxury Suite">
                    <div class="carousel-caption">
                        <h5><strong>Luxury Suite</strong></h5>
                        <p>Perfect for travelers looking for unparalleled luxury and comfort, featuring modern amenities and spacious living areas.</p>
                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="carousel-item">
                    <img src="assets/images/room2.jpg" alt="Royal Suite">
                    <div class="carousel-caption">
                        <h5><strong>Royal Suite</strong></h5>
                        <p>Known for its grand design, the Royal Suite is perfect for VIPs and those seeking exclusivity with stunning city views.</p>
                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="carousel-item">
                    <img src="assets/images/room3.jpg" alt="Presidential Suite">
                    <div class="carousel-caption">
                        <h5><strong>Presidential Suite</strong></h5>
                        <p>Designed for royalty, this suite offers supreme comfort and elegant luxury, ideal for intimate celebrations.</p>
                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

                <!-- Room 4 -->
                <div class="carousel-item">
                    <img src="assets/images/room4.jpg" alt="Garden View Room">
                    <div class="carousel-caption">
                        <h5><strong>Garden View Room</strong></h5>
                        <p>Relax and unwind in this serene room with a beautiful garden view, offering a calm and peaceful retreat.</p>
                        <a href="#" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

            </div>

            <!-- Carousel Controls -->
            <a class="carousel-control-prev" href="#roomCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#roomCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

</body>

</html>
