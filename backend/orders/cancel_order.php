<?php
require_once '../config/database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$orderId = $data['order_id'] ?? null;

if (!$orderId) {
    echo json_encode(['success' => false, 'message' => 'Missing order ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE orders SET order_status = 'cancelled' WHERE order_id = ?");
    $stmt->execute([$orderId]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
