<?php
// No whitespace before this opening tag

// Start the session first, before any output
session_start();

// Then include the database connection
require_once 'database-connection.php';

// Set the logged_in status
$logged_in = $_SESSION['logged_in'] ?? false;

function login($username)
{
    // Only regenerate ID if a session already exists
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
}

function require_login($logged_in)
{
    if ($logged_in == false) {
        header('Location: login.php');
        exit;
    }
}

function logout()
{
    $_SESSION = [];

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);

    session_destroy();
}

function authenticate(PDO $pdo, string $username, string $password): ?array
{
    // SQL query to retrieve the user with the provided username
    $sql = "SELECT * FROM loginInformation WHERE username = :username LIMIT 1";
    
    // Use proper PDO prepared statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        return $user; // Authentication successful
    }

    return null;
}
?>
