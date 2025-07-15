<?php 
session_start();
session_unset();
session_destroy();
localStorage.removeItem('isLoggedIn');
localStorage.removeItem('email');
window.location.href = '/K-M-Arts-and-Crafts-Creation/index.html';
exit();

?>