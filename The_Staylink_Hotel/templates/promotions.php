<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Staylink Hotel - Special Offers</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Raleway:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background: url('assets/images/room_booking.jpg') no-repeat center center/cover; /* Add your background image here */
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .promo-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 100px 20px;
            position: relative;
            text-align: center;
            z-index: 1;
        }

        .promo-container {
            position: relative;
            z-index: 2;
        }

        .promo-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ff6f61;
            margin-bottom: 30px;
            position: relative;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }

        .promo-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -15px;
            width: 80px;
            height: 6px;
            background: #ff6f61;
            border-radius: 5px;
        }

        .promo-notes {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .promo-note {
            width: 350px;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
            position: relative;
            transform: rotate(-2deg);
            transition: transform 0.4s cubic-bezier(0.25, 0.1, 0.25, 1), box-shadow 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
            border: 1px solid #e0e0e0;
            background: linear-gradient(145deg, #fff, #f9f9f9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .promo-note:nth-of-type(odd) {
            transform: rotate(2deg);
        }

        .promo-note:nth-of-type(even) {
            transform: rotate(-2deg);
        }

        .promo-note::before {
            content: "";
            position: absolute;
            top: -30px;
            left: 25px;
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-bottom: 30px solid #fff;
            transform: rotate(45deg);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .promo-note .note-content {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.4rem;
            color: #333;
            margin: 0;
        }

        .promo-note .note-heading {
            font-weight: 700;
            color: #ff6f61;
            margin-bottom: 15px;
            font-size: 1.6rem;
        }

        .promo-note .note-text {
            margin-top: 15px;
            font-size: 1.1rem;
        }

        .promo-note .note-pin {
            position: absolute;
            top: -35px;
            right: 25px;
            width: 35px;
            height: 35px;
            background: #ff6f61;
            border-radius: 50%;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            transform: rotate(45deg);
            transition: transform 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
        }

        .promo-note .note-pin::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            width: 15px;
            height: 15px;
            background: #fff;
            border-radius: 50%;
        }

        .promo-note:hover {
            transform: rotate(0deg);
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.5);
        }

        .promo-note:hover .note-pin {
            transform: rotate(0deg);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .promo-title {
                font-size: 3rem;
            }
            .promo-note {
                width: 300px;
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .promo-title {
                font-size: 2.5rem;
            }
            .promo-note {
                width: 250px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Promotion Section -->
    <section class="promo-section">
        <div class="promo-container">
            <h1 class="promo-title">Exclusive Staylink Hotel Promotions</h1>
            <div class="promo-notes">
                <!-- Promo Notes -->
                <div class="promo-note" data-aos="fade-up" data-aos-delay="100">
                    <div class="note-pin"></div>
                    <h3 class="note-heading">Limited Time Offer</h3>
                    <p class="note-content note-text">Get 20% off on all room bookings! Book your stay today and save big.</p>
                </div>

                <div class="promo-note" data-aos="fade-up" data-aos-delay="200">
                    <div class="note-pin"></div>
                    <h3 class="note-heading">Exclusive Spa Packages</h3>
                    <p class="note-content note-text">Indulge in luxury with our exclusive spa treatments at discounted rates for all guests.</p>
                </div>

                <div class="promo-note" data-aos="fade-up" data-aos-delay="300">
                    <div class="note-pin"></div>
                    <h3 class="note-heading">Weekend Getaways</h3>
                    <p class="note-content note-text">Escape the routine with our special weekend packages offering the best of The Staylink Hotel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap, jQuery, AOS JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        $(document).ready(function() {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out'
            });
        });
    </script>

</body>
</html>
