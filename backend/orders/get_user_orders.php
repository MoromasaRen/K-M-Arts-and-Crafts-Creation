<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT o.order_id, o.quantity, p.product_name, d.status AS delivery_status
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        JOIN deliveries d ON o.delivery_id = d.delivery_id
        WHERE o.user_id = ?
          AND d.status = 'Delivered'
    ");
    $stmt->execute([$userId]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'orders' => $orders]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
