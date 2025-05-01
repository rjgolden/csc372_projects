<?php
  // Include the session script
  require_once 'includes/session.php';

  // At the very top of your login.php file, add this debugging code
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  // If already logged in
  if ($logged_in) {
    // Redirect to profile page  
    header('Location: login.php');
    // Stop further code running
    exit;
  }    

  // Initialize error message variable
  $error_message = '';

  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize username and password
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input
    if (empty($username) || empty($password)) {
      $error_message = "Please enter both username and password.";
    } else {
      // Check if the user exists and authenticate
      try {
        // Prepare a statement to check if the username exists in the loginInformation table
        $stmt = $pdo->prepare("SELECT * FROM loginInformation WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
          // User exists, now verify password
          // Assuming passwords are stored with password_hash()
          if (password_verify($password, $user['password'])) {
              login($username);
              $base_url = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
              header("Location: {$base_url}/profile.php");
              exit;
          }

          else {
            // Password is incorrect
            $error_message = "Invalid username or password.";
          }
        } else {
          // User doesn't exist
          $error_message = "Invalid username or password.";
        }
      } catch (PDOException $e) {
        // Handle database errors
        $error_message = "A database error occurred. Please try again later.";
        // For debugging (remove in production):
        // $error_message .= " Error: " . $e->getMessage();
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste of Italy Login Page</title>
    <link rel="stylesheet" href="css/formStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Press Start 2P">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <header>
      <div class="header-left">
        <div class="logo">
            <a class="navbar-brand" href="index.php">
            <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160" justify = "center">
            </a>
        </div>
      </div>
    </header>

    <div id="content" class="animate-bottom">
      <h1>Log In to Taste of Italy!</h1>
      <hr />
      <br />
 
      <?php if (!empty($error_message)): ?>
        <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error_message); ?></p>
      <?php endif; ?>

      <form method="POST" action="login.php">
        Username: <input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"><br> <br>
        Password: <br><input type="password" name="password" value = ""><br> <br>
        <input type="submit" value="Log In">
      </form>
      
      <p>Don't have an account? <a href="register.php">Register here</a></p>
      <p><a href="index.php">Back to Home</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
      // Cache jQuery selections
      const $cache = {
        loginForm: $('form'),
        usernameInput: $('input[name="username"]'),
        passwordInput: $('input[name="password"]')
      };
      
      $cache.loginForm.on('submit', function(event) {
        // Form validation can be handled here
      });
    });
    </script>

     <!-- Script for Smooth Loading Effects -->
     <script src="js/jQuery.js"></script>
     <script src="js/smooth.js"></script>
  </body>
</html>
