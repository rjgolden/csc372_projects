<?php
    // Include the database connection script
    require 'database-connection.php';

    // Ensure no output has been sent before headers/sessions
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $logged_in = $_SESSION['logged_in'] ?? false;           // Is user logged in?

    function login($username)
    {
        session_regenerate_id(true);           // Regenerate session ID
        $_SESSION['logged_in'] = true;        // Mark as logged in
        $_SESSION['username'] = $username;    // Save username
    }

    function require_login($logged_in)              // Check if user logged in
    {
        if ($logged_in == false) {                 // If not logged in
            header('Location: login.php');        // Send to login page
            exit;                                // Stop rest of page running
        }
    }


    function logout()                                   // Terminate the session
    {
        $_SESSION = [];                                 // Clear contents of array  


        $params = session_get_cookie_params();          // Get session cookie parameters
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
            $params['secure'], $params['httponly']);    // Delete session cookie


        session_destroy();                              // Delete session file
    }




    /*
       TO-DO: Define a function that authenticates a user based on the provided username and password.


        Parameters:
        - $pdo: PDO object representing the database connection
        - $username: The username of the user to authenticate
        - $password: The password of the user to authenticate


        Returns:
        - An array representing the authenticated user if successful, otherwise returns null.


       
        - Write SQL query to retrieve the user with the provided username and password
        - Execute the SQL query using the pdo function and fetch the result
        - Return the user info
     */
    function authenticate(PDO $pdo, string $username, string $password): ?array
{
        // SQL query to retrieve the user with the provided username
        // CHANGED FROM "users" TO "loginInformation"
        $sql = "SELECT * FROM loginInformation WHERE username = ? LIMIT 1";
        $user = pdo($pdo, $sql, [$username])->fetch();

        // Check if user exists and password matches
        if ($user && $user['password'] === $password) {
            return $user; // Authentication successful
        }

        return null;
    }
    
    
?>
    
