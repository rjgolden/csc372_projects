<?php
    // Include the session script
    include 'includes/session.php';

    // Redirect user if not logged in
    require_login($logged_in);

    // Retrieve the username from the session data
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Taste of Italy - Profile</title>
        <link rel="stylesheet" href="css/styleSheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Press Start 2P">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class="header-left">
                <div class="logo">
                    <a class="navbar-brand" href="index.html">
                    <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
                    </a>
                </div>
            </div>
        </header>

        <div id="content" class="animate-bottom">
            <h1>Welcome to Your Profile</h1>
            <hr />
            <br />

            <div class="profile-container">
                <h2>Hi, <?= htmlspecialchars($username) ?>!</h2>
                <p>Thanks for logging in to Taste of Italy.</p>
                
                <div class="action-buttons">
                    <a href="index.php" class="button">Back to Main Page</a> <br> <br>
                    <a href="logout.php" class="button">Log Out</a>
                </div>
            </div>
        </div>

         <!-- Script for Smooth Loading Effects -->
         <script src="js/jQuery.js"></script>
        <script src="js/smooth.js"></script>
    </body>
</html>