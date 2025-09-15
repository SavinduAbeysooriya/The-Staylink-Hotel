<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision & Mission - The Staylink Hotel</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1c1c1c;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }

        .vision-section {
            padding: 100px 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(30, 30, 30, 0.9)),
                url('assets/images/vision-background.jpg') no-repeat center center/cover;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.5);
        }

        .vision-title {
            text-align: center;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffcc00;
            margin-bottom: 40px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
            letter-spacing: 2px;
        }

        .vision-content {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(30, 30, 30, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .vision-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8);
        }

        .vision-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #f2f2f2;
            position: relative;
            text-transform: uppercase;
        }

        .vision-content h3::after {
            content: "";
            display: block;
            width: 50px;
            height: 4px;
            background: #ffcc00;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .vision-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #ddd;
            text-align: justify;
            position: relative;
        }

        .vision-content p::before {
            content: '';
            position: absolute;
            top: 5px;
            left: -10px;
            width: 10px;
            height: 10px;
            background: #ffcc00;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.7);
        }

        /* AOS Animation */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            background: #333;
        }

        ::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #777;
        }
    </style>
</head>

<body>

    <!-- Vision Section -->
    <section class="vision-section">
        <div class="container">
            <h2 class="vision-title" data-aos="fade-down">Our Vision & Mission</h2>
            <div class="vision-content" data-aos="fade-up" data-aos-delay="200">
                <h3>Our Vision</h3>
                <p>At The Staylink Hotel, we aspire to create a sanctuary where art and coffee blend seamlessly, offering an immersive experience that ignites creativity and inspires connection among our guests.</p>

                <h3>Our Mission</h3>
                <p>Our mission is to provide the highest quality coffee and culinary delights, fostering a welcoming atmosphere that encourages our community to gather, share stories, and indulge in the beauty of life’s simple pleasures.</p>
            </div>
        </div>
    </section>

    <!-- Bootstrap, jQuery, and AOS JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        $(document).ready(function () {
            AOS.init({
                duration: 800,
                once: true,
            });
        });
    </script>

</body>

</html>
