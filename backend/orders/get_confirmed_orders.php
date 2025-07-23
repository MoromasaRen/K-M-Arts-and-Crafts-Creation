<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    $sql = "SELECT o.order_id, o.order_details, o.total_amount, o.status 
            FROM orders o 
            WHERE o.status = 'confirmed' 
            AND NOT EXISTS (
                SELECT 1 FROM deliveries d 
                WHERE d.order_id = o.order_id
            )
            ORDER BY o.order_date DESC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $orders
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
