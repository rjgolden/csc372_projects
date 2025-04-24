<?php


    // Include the database connection script
    require 'database-connection.php';


    session_start();                                         // Start/renew session


    $logged_in = $_SESSION['logged_in'] ?? false;           // Is user logged in?




    function login($username)                             // Remember user passed login
    {
        session_regenerate_id(true);                     // Update session id
        $_SESSION['logged_in'] = true;                  // Set logged_in key to true
        $_SESSION['username'] = $username;             // Set username key to one from form
    }



    
    function require_login($logged_in)
    {
        if ($logged_in == false) {
            // Get the server protocol (http or https)
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            
            // Get the server name and script directory
            $host = $_SERVER['HTTP_HOST'];
            $directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
            
            // Build the full URL for the login page
            $url = $protocol . $host . $directory . '/login.php';
            
            // Redirect with absolute URL
            header("Location: $url");
            exit;
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
    
