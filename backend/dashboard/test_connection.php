<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    // Test database connection
    $test_query = "SELECT 
        (SELECT COUNT(*) FROM orders WHERE status = 'pending') as pending_count,
        (SELECT COUNT(*) FROM orders WHERE status = 'completed') as completed_count,
        (SELECT COUNT(*) FROM deliveries WHERE delivery_status = 'scheduled') as scheduled_count,
        (SELECT COUNT(*) FROM deliveries WHERE delivery_status = 'in_transit') as transit_count
    ";
    
    $stmt = $pdo->prepare($test_query);
    $stmt->execute();
    $counts = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get today's orders
    $today = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT COUNT(*) as today_count FROM orders WHERE DATE(order_date) = :today");
    $stmt->execute(['today' => $today]);
    $today_count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get all order statuses for debugging
    $stmt = $pdo->prepare("SELECT status, COUNT(*) as count FROM orders GROUP BY status");
    $stmt->execute();
    $status_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'database_connection' => 'success',
        'counts' => $counts,
        'today_orders' => $today_count,
        'status_distribution' => $status_counts,
        'current_date' => $today,
        'server_time' => date('Y-m-d H:i:s')
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'database_connection' => 'failed',
        'error' => $e->getMessage()
    ]);
}
