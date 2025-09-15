<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | The Staylink Hotel</title>

    <!-- Bootstrap and jQuery CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Menu Section -->
    <section id="menu" class="py-5">
        <div class="container text-center">
            <h2 class="text-uppercase mb-4 display-4 text-light" data-aos="fade-down">Our Refined Menu</h2>

            <!-- Category and Sort Filters -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <select id="category-filter" class="form-control bg-dark text-light border-0" data-aos="fade-right">
                        <option value="">All Categories</option>
                        <!-- Categories will be loaded dynamically here -->
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <select id="sort-filter" class="form-control bg-dark text-light border-0" data-aos="fade-left">
                        <option value="">Sort by</option>
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
                    </select>
                </div>
            </div>

            <!-- Menu Items -->
            <div id="menuContainer" class="row g-4">
                <!-- Menu items will be dynamically loaded here via AJAX -->
            </div>
        </div>
    </section>


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
