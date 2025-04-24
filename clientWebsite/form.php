<?php
// Start session at the very beginning
session_start();

require_once 'validate.php';

// Initialize form data with default values
$formData = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'age' => '',
    'contact_method' => '',
    'service' => '',
    'message' => ''
];

// Initialize error messages
$errors = [
    'name' => '',
    'email' => '',
    'age' => '',
    'contact_method' => '',
    'service' => ''
];

// Initialize result message
$resultMessage = '';

// Initialize session message
$sessionMessage = '';

// Check if session has user data
if (isset($_SESSION['user_data'])) {
    $sessionMessage = '<div class="session-info">
        <h3>Current Session Data</h3>
        <p>Name: ' . htmlspecialchars($_SESSION['user_data']['name']) . '</p>
        <p>Email: ' . htmlspecialchars($_SESSION['user_data']['email']) . '</p>
        <p>Last Form Submission: ' . htmlspecialchars($_SESSION['user_data']['submission_time']) . '</p>
        <form method="POST" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
            <input type="hidden" name="end_session" value="1">
            <button type="submit" class="session-end-btn">End Session</button>
        </form>
    </div>';
}

// Check if end session is requested
if (isset($_POST['end_session'])) {
    // Clear session data
    $_SESSION = [];
    
    // If it's desired to kill the session, also delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finally, destroy the session
    session_destroy();
    
    // Redirect to the same page to refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Cookie message initialization
$cookieMessage = '';

// Check if cookie exists and display it
if (isset($_COOKIE['user_preference'])) {
    $cookieData = json_decode($_COOKIE['user_preference'], true);
    if ($cookieData) {
        $cookieMessage = '<div class="cookie-info">
            <h3>Your Stored Preferences</h3>
            <p>Preferred Service: ' . htmlspecialchars($cookieData['preferred_service']) . '</p>
            <p>Contact Method: ' . htmlspecialchars($cookieData['contact_method']) . '</p>
            <p>Cookie Set On: ' . htmlspecialchars($cookieData['timestamp']) . '</p>
        </div>';
    }
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['end_session'])) {
    // Collect data from form and overwrite initial values
    $formData['name'] = $_POST['name'] ?? '';
    $formData['email'] = $_POST['email'] ?? '';
    $formData['phone'] = $_POST['phone'] ?? '';
    $formData['age'] = $_POST['age'] ?? '';
    $formData['contact_method'] = $_POST['contact_method'] ?? '';
    $formData['service'] = $_POST['service'] ?? '';
    $formData['message'] = $_POST['message'] ?? '';
    
    // Validate name (between 2 and 50 characters)
    if (!validateTextLength($formData['name'], 2, 50)) {
        $errors['name'] = 'Name must be between 2 and 50 characters.';
    }
    
    // Validate email (using PHP's built-in email validation)
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    
    // Validate age (between 18 and 120) if provided
    if (!empty($formData['age']) && !validateNumberRange($formData['age'], 18, 120)) {
        $errors['age'] = 'Age must be between 18 and 120.';
    }
    
    // Validate contact method
    $validContactMethods = ['email', 'phone', 'both'];
    if (!empty($formData['contact_method']) && !validateOption($formData['contact_method'], $validContactMethods)) {
        $errors['contact_method'] = 'Please select a valid contact method.';
    }
    
    // Validate service selection
    $validServices = ['web_design', 'web_development', 'seo', 'content', 'maintenance'];
    if (!empty($formData['service']) && !validateOption($formData['service'], $validServices)) {
        $errors['service'] = 'Please select a valid service.';
    }
    
    // Join all error messages
    $errorMessages = array_filter($errors); // Remove empty error messages
    $errorString = implode(', ', $errorMessages);
    
    // Set result message
    if (empty($errorString)) {
        $resultMessage = '<div class="success-message">Your form has been submitted successfully! Redirecting to home page...</div>';
        
        // Create cookie with user preferences
        if (!empty($formData['service']) && !empty($formData['contact_method'])) {
            $cookieData = [
                'preferred_service' => $formData['service'],
                'contact_method' => $formData['contact_method'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
            // Set cookie for 30 days
            setcookie(
                'user_preference',
                json_encode($cookieData),
                time() + (86400 * 30), // 30 days
                '/',
                '',
                false,
                true // httponly
            );
        }
        
        // Store session data
        $_SESSION['user_data'] = [
            'name' => $formData['name'],
            'email' => $formData['email'],
            'submission_time' => date('Y-m-d H:i:s')
        ];
        
        // In a real application, you would process the form data here
        // For example: save to database, send email, etc.
        
        // Reset form data after successful submission
        $formData = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'age' => '',
            'contact_method' => '',
            'service' => '',
            'message' => ''
        ];
        
        // Add JavaScript to redirect after showing the success message
        echo '<script>
            setTimeout(function() {
                window.location.href = "index.html";
            }, 3000); // Redirect after 3 seconds
        </script>';
    } else {
        $resultMessage = '<div class="error-message">Please correct the following errors: ' . $errorString . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .radio-group {
            margin: 10px 0;
        }
        .radio-option {
            margin-right: 15px;
            display: inline-block;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .session-end-btn {
            background-color: #dc3545;
        }
        .session-end-btn:hover {
            background-color: #c82333;
        }
        .error {
            color: #D8000C;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .success-message {
            background-color: #DFF2BF;
            color: #4F8A10;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .error-message {
            background-color: #FFBABA;
            color: #D8000C;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .cookie-info, .session-info {
            background-color: #E7F3FE;
            border-left: 6px solid #2196F3;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .cookie-info h3, .session-info h3 {
            margin-top: 0;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    
    <?php 
    // Display result message
    echo $resultMessage; 
    
    // Display cookie data if available
    echo $cookieMessage;
    
    // Display session data if available
    echo $sessionMessage;
    ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($formData['name']); ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <div class="error"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>
            <?php if (!empty($errors['email'])): ?>
                <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($formData['phone']); ?>">
        </div>
        
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($formData['age']); ?>" min="18" max="120">
            <?php if (!empty($errors['age'])): ?>
                <div class="error"><?php echo $errors['age']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Preferred Contact Method:</label>
            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="contact_method" value="email" <?php echo ($formData['contact_method'] === 'email') ? 'checked' : ''; ?>> Email
                </label>
                <label class="radio-option">
                    <input type="radio" name="contact_method" value="phone" <?php echo ($formData['contact_method'] === 'phone') ? 'checked' : ''; ?>> Phone
                </label>
                <label class="radio-option">
                    <input type="radio" name="contact_method" value="both" <?php echo ($formData['contact_method'] === 'both') ? 'checked' : ''; ?>> Both
                </label>
            </div>
            <?php if (!empty($errors['contact_method'])): ?>
                <div class="error"><?php echo $errors['contact_method']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="5"><?php echo htmlspecialchars($formData['message']); ?></textarea>
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>