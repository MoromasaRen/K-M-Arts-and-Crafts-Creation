echo json_encode([
    "status" => "KM Arts Backend API is running",
    "endpoints" => [
        "/auth/login.php",
        "/products/create.php",
        "/products/read.php",
        "/products/update.php",
        "/products/delete.php",
        "/orders/create.php",
        "/orders/read.php",
        "/orders/update_status.php",
        "/deliveries/assign.php",
        "/deliveries/update_status.php",
        "/users/register_staff.php"
    ]
]);
