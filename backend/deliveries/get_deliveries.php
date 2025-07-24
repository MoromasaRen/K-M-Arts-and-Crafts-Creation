<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    if (!isset($_GET['order_id'])) {
        throw new Exception('Order ID is required');
    }

    $orderId = $_GET['order_id'];
    
    $query = "SELECT o.*, u.first_name, u.last_name 
              FROM orders o 
              LEFT JOIN users u ON o.user_id = u.user_id 
              WHERE o.order_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception('Order not found');
    }
    
    $order = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'data' => $order
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>