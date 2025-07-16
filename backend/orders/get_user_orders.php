<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

$sql = "
    SELECT 
        o.Order_ID,
        o.Order_Details,
        o.Status AS order_status,
        o.Total_Amount,
        p.Amount_paid,
        p.Mode_of_payment,
        p.Payment_Status,
        d.Delivery_Status
    FROM Orders o
    LEFT JOIN Payment p ON o.Order_ID = p.Order_ID
    LEFT JOIN Delivery d ON o.Order_ID = d.Order_ID
    WHERE o.User_ID = ?
    ORDER BY o.Order_Date DESC
";

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
