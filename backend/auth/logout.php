<?php 
session_start();
session_unset();
session_destroy();

header("Location: /K-M-Arts-and-Crafts-Creation/index.php");
exit();

?>