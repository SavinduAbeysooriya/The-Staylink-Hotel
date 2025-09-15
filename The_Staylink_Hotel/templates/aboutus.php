<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Staylink Hotel</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fafafa;
      color: #333;
      overflow-x: hidden;
    }

    /* About Us Section */
    #about-us {
      background: linear-gradient(135deg, #00bfae, #2b9f8d);
      padding: 120px 0;
      text-align: center;
      color: #f9f9f9;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    #about-us::before {
      content: '';
      position: absolute;
      top: -20%;
      left: -20%;
      width: 140%;
      height: 140%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
      opacity: 0.15;
      transform: rotate(-20deg);
    }

    #about-us h2 {
      font-size: 4rem;
      font-weight: 600;
      font-family: 'Playfair Display', serif;
      letter-spacing: 2px;
      margin-bottom: 20px;
      text-transform: uppercase;
      color: #ffffff;
      transition: transform 1s ease-out, opacity 1s ease-out;
      opacity: 0;
      transform: translateY(50px);
    }

    #about-us p {
      font-size: 1.25rem;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.8;
      max-width: 900px;
      margin: 0 auto 30px;
      padding: 0 15px;
      opacity: 0;
      transform: translateY(40px);
      transition: transform 1s ease-out, opacity 1s ease-out;
    }

    /* Team Section */
    .team-section {
      background: #f3f4f7;
      padding: 100px 0;
      text-align: center;
      position: relative;
    }

    .team-section h3 {
      font-size: 3.8rem;
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      margin-bottom: 60px;
      opacity: 0;
      transform: translateY(50px);
      transition: all 1.2s ease-in-out;
    }

    .team-member {
      background: #fff;
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.5s ease;
      opacity: 0;
      transform: translateY(40px);
      transition: all 1.2s ease-in-out;
    }

    .team-member:hover {
      transform: translateY(-10px);
      box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
    }

    .team-member img {
      width: 100%;
      height: 280px;
      border-radius: 15px;
      object-fit: cover;
      margin-bottom: 20px;
      transition: transform 0.5s ease;
    }

    .team-member:hover img {
      transform: scale(1.1);
    }

    .team-member h5 {
      font-size: 1.8rem;
      color: #2E4053;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .team-member span {
      font-size: 1.3rem;
      color: #8b8b8b;
      display: block;
      margin-bottom: 15px;
    }

    .team-member p {
      font-size: 1.1rem;
      color: #555;
      line-height: 1.6;
    }

    /* Scroll Animations */
    .fade-in {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      #about-us h2 {
        font-size: 3rem;
      }

      .team-section h3 {
        font-size: 3rem;
      }
    }
  </style>
</head>

<body>
  <!-- About Us Section -->
  <section id="about-us">
    <div class="container">
      <h2 class="scroll-trigger">Welcome to Staylink Hotel</h2>
      <p class="scroll-trigger">Nestled in the heart of Colombo, Staylink Hotel blends the essence of Sri Lanka's rich culture with world-class modern amenities. Our serene environment and elegant rooms offer the perfect retreat for travelers from around the world.</p>
      <p class="scroll-trigger">At Staylink, we believe in offering an authentic Sri Lankan experience with the utmost luxury. Whether you are here for relaxation or business, our hotel provides the best of both worlds.</p>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team-section">
    <div class="container">
      <h3 class="scroll-trigger">Meet Our Exceptional Team</h3>
      <div class="row">
        <!-- Team Member 1 -->
        <div class="col-md-4 mb-4">
          <div class="team-member scroll-trigger">
            <img src="assets/images/team-member1.jpg" alt="Aruna Perera">
            <h5>Aruna Perera</h5>
            <span>Executive Chef</span>
            <p>Aruna brings a wealth of culinary expertise, specializing in Sri Lankan fusion dishes that blend tradition with contemporary flair. His passion for Sri Lankan cuisine elevates every dish.</p>
          </div>
        </div>

        <!-- Team Member 2 -->
        <div class="col-md-4 mb-4">
          <div class="team-member scroll-trigger">
            <img src="assets/images/team-member2.jpg" alt="Priya Fernando">
            <h5>Priya Fernando</h5>
            <span>Hotel Manager</span>
            <p>Priya's commitment to exceptional service ensures that every guest enjoys a personalized experience at Staylink. With over 15 years in hospitality, she curates unforgettable stays for every visitor.</p>
          </div>
        </div>

        <!-- Team Member 3 -->
        <div class="col-md-4 mb-4">
          <div class="team-member scroll-trigger">
            <img src="assets/images/team-member3.jpg" alt="Nadeesha Wijesinghe">
            <h5>Nadeesha Wijesinghe</h5>
            <span>Art Curator</span>
            <p>Nadeesha is passionate about showcasing Sri Lanka’s artistic legacy. She curates exceptional collections of contemporary and traditional Sri Lankan art displayed throughout the hotel.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to check if element is in viewport
    function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }

    // Scroll-triggered animation
    function handleScrollAnimation() {
      const elements = document.querySelectorAll('.scroll-trigger');
      elements.forEach(el => {
        if (isElementInViewport(el)) {
          el.classList.add('fade-in');
        }
      });
    }

    // Run function on scroll and load
    window.addEventListener('scroll', handleScrollAnimation);
    window.addEventListener('load', handleScrollAnimation);
  </script>
</body>

</html>
