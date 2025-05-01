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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="specials.php">Prepared Foods</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="social.php">Social Media</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $logged_in ? 'logout.php' : 'login.php' ?>"><?= $logged_in ? 'Log Out' : 'Log In' ?></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content container text-center">
            <h1 class="display-4">Welcome to Taste of Italy</h1>
            <p class="lead">Authentic Italian Cuisine in Johnston, RI</p>
            <p class = "normalFont2"> At Taste of Italy, we bring the warmth and tradition of authentic Italian cuisine to your neighborhood. 
From hot sandwiches and freshly prepared foods to decadent desserts and evber changing specials, every item is made with premium ingredients and genuine Italian passion. Our deli counter features a tempting array of ready-to-enjoy specialties perfect for a quick lunch or an effortless family dinner.
Visit us today to experience the true flavors of Italy in every bite! </p> 
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>© 2025 Taste of Italy. All rights reserved.</p>
            <p>123 Main Street, Johnston, RI 02919 | (401) 555-0123</p>
            <p> Created by: Ryan Golden <br> Email: <a href="mailto:your.email@example.com"> ryan_golden@uri.edu </a> </p>
            <img src = "images/Logo2.png" alt="Taste of Italy Logo 2" width = "120" height = "80">
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/jQuery.js"></script>
     <!-- Script for Smooth Loading Effects -->
    <script src="js/smooth.js"></script>
</body>
</html>