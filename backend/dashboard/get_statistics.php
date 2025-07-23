<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    $response = [];
    
    // 1. New Orders (Last 24 hours)
    $last24Hours = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE order_date >= :last24Hours");
    $stmt->execute(['last24Hours' => $last24Hours]);
    $response['new_orders'] = (int)$stmt->fetchColumn();
    
    // Add debug timestamp information
    $response['debug_timestamp'] = [
        'server_time' => date('Y-m-d H:i:s'),
        'last_24_hours_from' => $last24Hours
    ];
    
    // Add debug information
    $stmt = $pdo->prepare("
        SELECT status, COUNT(*) as count 
        FROM orders 
        GROUP BY status
    ");
    $stmt->execute();
    $response['debug_order_counts'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Pending Orders
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'pending'");
    $stmt->execute();
    $response['pending_orders'] = $stmt->fetchColumn();

    // 3. Scheduled Deliveries
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM deliveries WHERE delivery_status = 'scheduled'");
    $stmt->execute();
    $response['scheduled_deliveries'] = $stmt->fetchColumn();

    // 4. Deliveries in Transit
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM deliveries WHERE delivery_status = 'in_transit'");
    $stmt->execute();
    $response['in_transit_deliveries'] = $stmt->fetchColumn();

    // 5. Inventory Status
    $stmt = $pdo->prepare("
        SELECT status, COUNT(*) as count 
        FROM products 
        GROUP BY status 
        ORDER BY count DESC 
        LIMIT 1
    ");
    $stmt->execute();
    $inventoryStatus = $stmt->fetch(PDO::FETCH_ASSOC);
    $response['inventory_status'] = $inventoryStatus ? $inventoryStatus['status'] : 'Unknown';

    // 6. Completed Orders
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'completed'");
    $stmt->execute();
    $response['completed_orders'] = $stmt->fetchColumn();

    echo json_encode([
        'success' => true,
        'data' => $response
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
