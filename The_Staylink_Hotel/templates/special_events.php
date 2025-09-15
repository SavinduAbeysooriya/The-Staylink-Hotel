<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Special Events | The Staylink Hotel</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <style>
    body {
      background-color: #121212; /* Deep dark background for mystery */
      color: #f5f5f5; /* Light text color for readability */
      font-family: 'Inter', sans-serif;
      overflow-x: hidden; /* Prevent horizontal overflow */
    }

    #special-events {
      padding: 80px 0;
      position: relative;
      text-align: center;
      background: radial-gradient(circle, rgba(50, 50, 50, 0.9) 30%, rgba(20, 20, 20, 0.9) 100%);
      border-top: 2px solid #d4af37; /* Gold border for elegance */
      border-bottom: 2px solid #d4af37; /* Gold border for elegance */
    }

    h2 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      text-transform: uppercase;
      color: #d4af37; /* Gold color for elegance */
      animation: fadeInDown 0.8s ease-out;
    }

    p {
      font-size: 1.5rem;
      margin-bottom: 40px;
      animation: fadeInUp 1s ease-out;
      color: #e0e0e0; /* Slightly lighter color for the paragraph */
    }

    .event-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px; /* Spacing between cards */
      justify-items: center;
      margin-top: 20px;
    }

    .event-card {
      background: rgba(255, 255, 255, 0.05); /* Darker semi-transparent card background */
      border-radius: 20px; /* More rounded corners */
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4); /* Enhanced shadow for depth */
      backdrop-filter: blur(15px); /* Glassmorphism effect */
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 25px; /* Increased padding for a spacious feel */
      height: 400px; /* Fixed height for uniformity */
      overflow: hidden; /* Hide overflow for consistent look */

      &:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(255, 255, 255, 0.3);
      }
    }

    .card-img {
      width: 200px; /* Fixed width for uniformity */
      height: 200px; /* Fixed height for uniformity */
      object-fit: cover;
      border-radius: 15px; /* Rounded corners for images */
      margin-bottom: 15px; /* Spacing below image */
      border: 2px solid #d4af37; /* Gold border for images */
      transition: transform 0.3s ease;

      &:hover {
        transform: scale(1.05);
      }
    }

    .card-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: #d4af37; /* Gold color for titles */
    }

    .card-text {
      font-size: 1.1rem;
      color: #e0e0e0; /* Lighter color for text */
      line-height: 1.6;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body data-aos-easing="ease-in-out" data-aos-duration="1000">

  <section id="special-events">
    <div class="container">
      <h2 class="display-4">Special Events</h2>
      <p class="lead">Celebrate life's special moments with us.</p>

      <div class="event-grid">
        <div class="event-card" data-aos="fade-up">
          <img src="assets/images/corporate-event.jpg" class="card-img" alt="Corporate Events">
          <h5 class="card-title">Corporate Events</h5>
          <p class="card-text">Host your next corporate gathering in style with tailored packages for all occasions.</p>
        </div>
        <div class="event-card" data-aos="fade-up">
          <img src="assets/images/birthday-party.jpg" class="card-img" alt="Birthday Party">
          <h5 class="card-title">Birthday Parties</h5>
          <p class="card-text">Make your birthday unforgettable with our exquisite event planning services.</p>
        </div>
        <div class="event-card" data-aos="fade-up">
          <img src="assets/images/holiday-gathering.jpg" class="card-img" alt="Holiday Gatherings">
          <h5 class="card-title">Holiday Gatherings</h5>
          <p class="card-text">Celebrate the season with festive gatherings that create lasting memories.</p>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <script>
    AOS.init(); // Initialize AOS for scroll animations

    // Smooth scroll effect for any in-page anchor links (if needed for future sections)
    $('a[href^="#"]').on('click', function (e) {
      e.preventDefault();
      var target = this.hash;
      var $target = $(target);
      $('html, body').stop().animate({
        'scrollTop': $target.offset().top
      }, 900, 'swing');
    });
  </script>
</body>

</html>
