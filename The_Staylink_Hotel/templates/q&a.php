<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Section | Staylink Hotel</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fafafa;
      color: #333;
    }

    /* FAQ Section Styling */
    .faq-section {
      padding: 60px 0;
      background-color: #f8f8f8;
    }

    .faq-section h2 {
      font-size: 3rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 40px;
      color: #2e4053;
    }

    .faq-section .faq-question {
      background-color: #fff;
      border-radius: 8px;
      margin-bottom: 20px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .faq-question:hover {
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      transform: translateY(-5px);
    }

    .faq-question h5 {
      font-size: 1.6rem;
      font-weight: bold;
      color: #1abc9c;
      margin-bottom: 15px;
    }

    .faq-question .collapse {
      font-size: 1.2rem;
      color: #555;
      line-height: 1.6;
    }

    .faq-question .btn-link {
      color: #333;
      text-decoration: none;
      font-size: 1.2rem;
    }

    .faq-question .btn-link:focus,
    .faq-question .btn-link:hover {
      color: #1abc9c;
    }

    .faq-images {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .faq-images img {
      width: 48%;
      border-radius: 10px;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .faq-images img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .faq-images {
        flex-direction: column;
        align-items: center;
      }

      .faq-images img {
        width: 90%;
        margin-bottom: 20px;
      }

      .faq-section h2 {
        font-size: 2.2rem;
      }
    }
  </style>
</head>

<body>

  <!-- FAQ Section -->
  <section class="faq-section">
    <div class="container">
        <h3>A little bit more to Help You Plan</h3>
      <h2>Your Stay at Staylink Hotel</h2>
      
      <div class="accordion" id="faqAccordion">
        <!-- Question 1 -->
            <div class="faq-question" data-aos="fade-up">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    How can I place a Food Order?
                    </button>
                </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                <div class="card-body">
                    Please register and log in to our website. Once logged in, go to the <strong>Menu</strong> section where you can place food orders.
                </div>
                </div>
            </div>
            </div>


        <!-- Question 2 -->
        <div class="faq-question" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="false" aria-controls="collapseTwo">
                  Do you offer airport pick-up from Bandaranaike International Airport?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
              <div class="card-body">
                Yes, we provide airport pick-up services from Bandaranaike International Airport. Please contact us 24 hours prior to your arrival to arrange this service.
              </div>
            </div>
          </div>
        </div>

        <!-- Question 3 -->
        <div class="faq-question" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree"
                  aria-expanded="false" aria-controls="collapseThree">
                  Are pets allowed at Staylink Hotel?
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
              <div class="card-body">
                Yes, Staylink Hotel is pet-friendly! We welcome pets and offer special pet packages including designated pet rooms and pet amenities.
              </div>
            </div>
          </div>
        </div>

        <!-- Question 4 -->
        <div class="faq-question" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour"
                  aria-expanded="false" aria-controls="collapseFour">
                  How many restaurants and bars do you have at Staylink Hotel?
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
              <div class="card-body">
                Staylink Hotel offers 5 exquisite restaurants and 2 vibrant bars. Whether you're looking for international cuisine, Sri Lankan specialties, or a relaxing bar experience, we have something for everyone.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Images Section -->
      <div class="faq-images">
        <img src="assets/images/room1.jpg" alt="Staylink Hotel Room">
        <img src="assets/images/room2.jpg" alt="Dining Experience at Staylink">
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function () {
      // Initialize AOS
      AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true
      });
    });
  </script>
</body>

</html>
