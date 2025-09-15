<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - The Staylink Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            overflow-x: hidden;
            padding: 20px;
            scroll-behavior: smooth;
        }

        .facilities-section {
            padding: 60px 0;
            background-image: linear-gradient(to right, #434343, #000);
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .facilities-section h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 50px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .octagon-card {
            position: relative;
            width: 280px;
            height: 280px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3), 0 0 20px rgba(255, 255, 255, 0.2);
            transition: all 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transform-origin: center;
        }

        .octagon-card::before {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(60deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
            filter: blur(20px);
        }

        .octagon-card:hover::before {
            opacity: 1;
        }

        .octagon-card:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5), 0 0 25px rgba(0, 123, 255, 0.7);
            transform: translateY(-10px);
        }

        .facility-icon {
            font-size: 55px;
            color: #007bff;
            margin-bottom: 15px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .octagon-card:hover .facility-icon {
            transform: scale(1.2);
            color: #00bfff;
        }

        .facility-title {
            font-size: 1.6rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffffff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .facility-description {
            font-size: 1rem;
            color: #dddddd;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <section class="facilities-section">
        <h1>Our Facilities</h1>
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <!-- Octagon-Shaped Cards -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-coffee"></i>
                            <div class="facility-title">Coffee Shop</div>
                            <div class="facility-description">Enjoy freshly brewed coffee with a relaxing atmosphere.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-utensils"></i>
                            <div class="facility-title">Dining Area</div>
                            <div class="facility-description">Experience delicious meals in a cozy environment.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-wifi"></i>
                            <div class="facility-title">Free Wi-Fi</div>
                            <div class="facility-description">Stay connected with our high-speed internet access.</div>
                        </div>
                    </div>
                </div>
                <!-- Additional Facilities -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-swimming-pool"></i>
                            <div class="facility-title">Swimming Pool</div>
                            <div class="facility-description">Relax in our beautiful pool area with a stunning view.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-dumbbell"></i>
                            <div class="facility-title">Fitness Center</div>
                            <div class="facility-description">Stay fit during your visit with our state-of-the-art gym.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="octagon-card">
                        <div class="content">
                            <i class="facility-icon fas fa-spa"></i>
                            <div class="facility-title">Spa Services</div>
                            <div class="facility-description">Pamper yourself with relaxing spa treatments.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- JS for hover effects -->
    <script>
        $(document).ready(function() {
            $('.octagon-card').hover(function() {
                $(this).find('.facility-icon').addClass('animate__pulse');
            }, function() {
                $(this).find('.facility-icon').removeClass('animate__pulse');
            });
        });
    </script>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
