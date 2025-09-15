<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Staylink Hotel - Elegant Gallery</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">

    <!-- AOS CSS (for scroll animations) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: url('assets/images/room_booking.jpg') no-repeat center center/cover; /* Add your background image here */
            color: #333;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .gallery-section {
            padding: 80px 0;
            background: url('assets/images/room_booking.jpg') no-repeat center center/cover; /* Add your background image here */
            position: relative;
        }

        .gallery-title {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 50px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #333;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }

        .gallery-title::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 50%;
            height: 4px;
            background: #f7b7a3;
            transform: translateX(-50%);
            border-radius: 2px;
            box-shadow: 0 0 15px rgba(247, 183, 163, 0.5);
            animation: title-underline 2s infinite;
        }

        @keyframes title-underline {
            0% {
                transform: translateX(-50%) scaleX(0);
            }
            50% {
                transform: translateX(-50%) scaleX(1);
            }
            100% {
                transform: translateX(-50%) scaleX(0);
            }
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 0 20px;
        }

        .gallery-item {
            position: relative;
            width: 100%;
            max-width: 400px;
            height: 300px;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid #e0e0e0;
            background: rgba(255, 255, 255, 0.2); /* Light glassmorphism effect */
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.25);
        }

        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3); /* Glassmorphism effect */
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
            border-radius: 16px;
            text-align: center;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .overlay .text {
            color: #333;
            font-size: 1.5rem;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-shadow: 0 2px 4px rgba(255, 255, 255, 0.6);
            transform: scale(0);
            transition: transform 0.4s ease;
        }

        .gallery-item:hover .overlay .text {
            transform: scale(1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gallery-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .gallery-title {
                font-size: 2rem;
                margin-bottom: 40px;
            }
        }
    </style>
</head>
<body>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container-fluid p-0">
            <h2 class="gallery-title" data-aos="fade-down" data-aos-delay="100">Our Gallery</h2>
            <div class="gallery-grid" data-aos="fade-up" data-aos-delay="200">
                <!-- Gallery items -->
                <div class="gallery-item">
                    <img src="assets/images/image1.jpg" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="text">Elegant Dining</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/en.jpg" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="text">Exterior Night</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/lobby.jpg" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="text">Lobby</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/gbt.jpg" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="text">Grand Ballroom-Theatre Setting</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/fs.jpg" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="text">Fitness Centre</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/image2.jpg" alt="Gallery Image 2">
                    <div class="overlay">
                        <div class="text">Sophisticated Ambiance</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/image3.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="text">Signature Dishes</div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="assets/images/image4.jpg" alt="Gallery Image 4">
                    <div class="overlay">
                        <div class="text">Delectable Desserts</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap, jQuery, AOS, and Masonry JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <script>
        $(document).ready(function() {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out'
            });

            // Initialize Masonry layout
            var $grid = $('.gallery-grid').masonry({
                itemSelector: '.gallery-item',
                columnWidth: '.gallery-item',
                percentPosition: true
            });

            // Layout Masonry after each image loads
            $grid.imagesLoaded().progress(function() {
                $grid.masonry('layout');
            });
        });
    </script>

</body>
</html>
