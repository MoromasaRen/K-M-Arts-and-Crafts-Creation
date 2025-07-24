<?php
// File: backend/orders/get_user_orders.php
require_once '../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Only GET method allowed']);
    exit;
}

if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

$userId = (int)$_GET['user_id'];

try {
    // Query to get all orders for the user with proper status handling
    $stmt = $pdo->prepare("
        SELECT 
            o.order_id,
            o.order_details,
            o.order_date,
            o.total_amount,
            CASE 
                WHEN o.status = 'pending' THEN 'pending'
                WHEN o.status = 'confirmed' THEN 'confirmed'
                WHEN o.status = 'completed' THEN 'completed'
                ELSE o.status
            END as order_status
        FROM orders o 
        WHERE o.user_id = ? 
        ORDER BY o.order_date DESC
    ");
    
    $stmt->execute([$userId]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($orders)) {
        echo json_encode([
            'success' => true, 
            'message' => 'No orders found for this user',
            'orders' => []
        ]);
        exit;
    }
    
    // Format the orders data
    $formattedOrders = [];
    foreach ($orders as $order) {
        $formattedOrders[] = [
            'order_id' => $order['order_id'],
            'order_details' => $order['order_details'],
            'order_date' => $order['order_date'],
            'total_amount' => (float)$order['total_amount'],
            'order_status' => $order['order_status']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'orders' => $formattedOrders,
        'total_orders' => count($formattedOrders)
    ]);
    
} catch (PDOException $e) {
    error_log("Database error in get_user_orders.php: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Database error occurred',
        'error' => $e->getMessage()
    ]);
} catch (Exception $e) {
    error_log("General error in get_user_orders.php: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred while fetching orders',
        'error' => $e->getMessage()
    ]);
}
?>