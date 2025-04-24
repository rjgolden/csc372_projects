<?php
  // Include the session script
  require_once 'includes/session.php';
  
  // For debugging (remove in production)
  // echo "Logout process started...";
  
  // Clear all session variables
  $_SESSION = array();
  
  // Delete the session cookie
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }
  
  // Destroy the session
  session_destroy();
  
  // Call your logout function as a backup
  if (function_exists('logout')) {
      logout();
  }
  
  // Redirect to login page with a cache-busting parameter
  header("Location: login.php?logout=".time());
  exit;
?>