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
    SELECT 
        o.order_id,
        o.order_details,
        o.status AS order_status,
        o.total_amount,
        o.order_date
    FROM orders o
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
");

    $stmt->execute([$userId]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'orders' => $orders]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error',
        'error' => $e->getMessage()
    ]);
}
