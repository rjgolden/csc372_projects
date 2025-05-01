<?php
  // Include the session script
  require_once 'includes/session.php';

  // If already logged in
  if ($logged_in) {
    // Redirect to profile page  
    header('Location: profile.php');
    exit;
  }    

  // Initialize variables
  $error_message = '';
  $success_message = '';
  
  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Validate input
    if (empty($username) || empty($password)) {
      $error_message = "Both username and password are required.";
    } elseif (strlen($password) < 8) {
      $error_message = "Password must be at least 8 characters long.";
    } else {
      try {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM loginInformation WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
          $error_message = "Username already exists. Please choose a different one.";
        } else {
          // Hash the password
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          
          // Insert new user - just username and password
          $stmt = $pdo->prepare("INSERT INTO loginInformation (username, password) VALUES (:username, :password)");
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':password', $hashed_password);
          
          if ($stmt->execute()) {
            // Registration successful
            $success_message = "Registration successful! You can now log in.";
          } else {
            $error_message = "Registration failed. Please try again.";
            // For debugging (remove in production):
            $errorInfo = $stmt->errorInfo();
            $error_message .= " SQL Error: " . $errorInfo[2];
          }
        }
      } catch (PDOException $e) {
        // Handle database errors with specific information
        $error_message = "Database error: " . $e->getMessage();
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste of Italy - Register</title>
    <link rel="stylesheet" href="css/formStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Press Start 2P">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <header>
      <div class="header-left">
        <div class="logo">
            <a class="navbar-brand" href="index.php">
            <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
            </a>
        </div>
      </div>
    </header>

    <div id="content" class="animate-bottom">
      <h1>Register for Taste of Italy!</h1>
      <hr />
      <br />
 
      <?php if (!empty($error_message)): ?>
        <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error_message); ?></p>
      <?php endif; ?>
      
      <?php if (!empty($success_message)): ?>
        <p style="color:green; text-align:center;"><?php echo htmlspecialchars($success_message); ?></p>
        <p style="text-align:center;"><a href="login.php">Click here to log in</a></p>
      <?php else: ?>
        <form method="POST" action="register.php">
          <div class="form-group">
            Username: <input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required><br><br>
          </div>
          
          <div class="form-group">
            Password: <input type="password" name="password" required><br><br>
          </div>
          
          <input type="submit" value="Register">
        </form>
        
        <p>Already have an account? <a href="login.php">Log in here</a></p>
      <?php endif; ?>
    </div>

    <script src="js/jQuery.js"></script>
    <script>
    $(document).ready(function() {
      // Cache jQuery selections
      const $cache = {
        registerForm: $('form'),
        usernameInput: $('input[name="username"]'),
        passwordInput: $('input[name="password"]')
      };
      
      $cache.registerForm.on('submit', function(event) {
        // Form validation can be handled here
      });
    });
    </script>

     <!-- Script for Smooth Loading Effects -->
     <script src="js/smooth.js"></script>

  </body>
</html>