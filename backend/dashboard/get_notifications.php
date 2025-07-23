<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    // Get the 10 most recent orders with user and order details
    $stmt = $pdo->prepare("
        SELECT 
            o.order_id,
            o.order_details,
            o.order_quantity,
            o.order_date,
            CONCAT(u.first_name, ' ', u.last_name) as user_name
        FROM orders o
        JOIN users u ON o.user_id = u.user_id
        ORDER BY o.order_date DESC
        LIMIT 10
    ");
    
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the notifications
    $formattedNotifications = array_map(function($notification) {
        return [
            'id' => $notification['order_id'],
            'user_name' => $notification['user_name'],
            'details' => $notification['order_details'],
            'quantity' => $notification['order_quantity'],
            'timestamp' => $notification['order_date']
        ];
    }, $notifications);

    echo json_encode([
        'success' => true,
        'notifications' => $formattedNotifications
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
