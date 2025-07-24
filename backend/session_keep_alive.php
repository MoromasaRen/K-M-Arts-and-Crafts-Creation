<?php
session_start();

// Set timeout duration (15 minutes)
$timeout_duration = 900;

// Only run timeout logic if user is logged in
if (isset($_SESSION['user_id'])) {
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    // Optional: redirect if you want to notify user
    // header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html?timeout=1");
    // exit;
  } else {
    $_SESSION['LAST_ACTIVITY'] = time();
  }
}
?>
