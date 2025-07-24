<?php
session_start();

// Set timeout duration (e.g., 15 minutes = 900 seconds)
$timeout_duration = 900;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html");
  exit();
}

// Check if timeout is set
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  session_unset();     // Unset $_SESSION variables
  session_destroy();   // Destroy the session
  header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html?timeout=1");
  exit();
}

// Update last activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();
?>