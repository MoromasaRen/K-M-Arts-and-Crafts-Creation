<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->prepare("
        SELECT d.delivery_id, d.order_id, d.staff_id, d.scheduled_time, 
               d.delivery_status, d.courier_type, d.plate_number
        FROM deliveries d
        INNER JOIN orders o ON d.order_id = o.order_id
    ");
    $stmt->execute();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $deliveries
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Failed to fetch deliveries",
        "error" => $e->getMessage()
    ]);
}
?>
