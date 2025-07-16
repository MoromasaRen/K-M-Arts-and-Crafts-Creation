<?php
require_once '../../config/database.php'; // Adjust if path is different

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['order_id']) || !is_numeric($_POST['order_id'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid or missing order_id']);
    exit;
}

$orderId = (int)$_POST['order_id'];

try {
    // First delete order_items if there's a foreign key
    $stmtItems = $pdo->prepare("DELETE FROM order_items WHERE order_id = :order_id");
    $stmtItems->execute([':order_id' => $orderId]);

    // Then delete the order
    $stmtOrder = $pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
    $stmtOrder->execute([':order_id' => $orderId]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
