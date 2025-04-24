<?php
  // Include the session script
  require_once 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste of Italy - Johnston, RI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleSheet.css">
    </head>
    <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
            </a>
            <h1 class="title"> Taste of Italy • Deli & Caffè </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="specials.php">Specials</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="social.php">Social Media</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $logged_in ? 'logout.php' : 'login.php' ?>"><?= $logged_in ? 'Log Out' : 'Log In' ?></a></li>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="container py-5" id="contact">
        <div class="normalFont">
            <h2 class="menu">Contact Us</h2>
            <div class="row">
                <div class="col-md-6">
                    <form id="contactForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom">Send Message</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="ps-md-4">
                        <h3>Visit Us!</h3>
                        <p>1302 Atwood Avenue<br>Johnston, RI 02919</p>
                        <h3>Hours</h3>
                        <p>Monday - Saturday: 11AM - 9PM<br>Sunday: Closed</p>
                        <h3>Phone</h3>
                        <p>(401) 942-1234</p>
                        <button id="findDirections" class="btn btn-custom mt-2">Find Directions From My Location</button>
                    </div>
                </div>
            </div>
            
            <!-- Map Container -->
            <div class="row mt-4">
                <div class="col-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>© 2025 Taste of Italy. All rights reserved.</p>
            <p>123 Main Street, Johnston, RI 02919 | (401) 555-0123</p>
            <img src = "images/Logo2.png" alt="Taste of Italy Logo 2" width = "120" height = "80">
        </div>
    </footer>


    <!-- Load script for google maps -->
    <script src = "js/googleMapsAPI.js"></script>
    <!-- Load Google Maps API with your API key -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW_NNVIzqF8ItELFdowcZvnkjVA4KAY24&callback=initMap"> </script>

</body>
</html>