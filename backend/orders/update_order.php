<?php
// ../../backend/orders/update_order.php
require_once '../config/database.php';

// Set content type to JSON
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST method allowed');
    }

    // Get the input data
    $orderId = $_POST['order_id'] ?? null;
    $status = $_POST['status'] ?? null;

    // Validate required fields
    if (!$orderId) {
        throw new Exception('Order ID is required');
    }

    if (!$status) {
        throw new Exception('Status is required');
    }

    // Validate status values - include 'completed' for delivery updates
    $allowedStatuses = ['pending', 'confirmed', 'completed'];
    if (!in_array($status, $allowedStatuses)) {
        throw new Exception('Invalid status. Allowed: ' . implode(', ', $allowedStatuses));
    }

    // Check if order exists
    $checkStmt = $pdo->prepare("SELECT order_id FROM orders WHERE order_id = ?");
    $checkStmt->execute([$orderId]);
    
    if (!$checkStmt->fetch()) {
        throw new Exception('Order not found');
    }

    // Update the order status
    $updateStmt = $pdo->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $result = $updateStmt->execute([$status, $orderId]);

    if (!$result) {
        throw new Exception('Failed to update order status');
    }

    // Log the update for debugging
    error_log("Order #{$orderId} status updated to '{$status}'");

    echo json_encode([
        'success' => true,
        'message' => 'Order status updated successfully',
        'order_id' => $orderId,
        'new_status' => $status
    ]);

} catch (Exception $e) {
    error_log("Error updating order: " . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>