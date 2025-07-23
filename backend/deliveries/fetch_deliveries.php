<?php
require_once '../../backend/config/database.php';

try {
    $page = (int)($_GET['page'] ?? 1);
    $limit = (int)($_GET['limit'] ?? 15);
    $offset = ($page - 1) * $limit;
    $status = $_GET['status'] ?? '';
    $search = $_GET['search'] ?? '';

    // Build the query with proper JOINs
    $sql = "SELECT 
                d.delivery_id,
                d.order_id,
                d.user_id,
                d.scheduled_time,
                d.delivery_status,
                d.courier_type,
                d.plate_number,
                CONCAT(u.first_name, ' ', u.last_name) as user_info,
                u.first_name,
                u.last_name,
                o.order_details,
                o.order_details as order_info,
                o.status as order_status
            FROM deliveries d
            LEFT JOIN users u ON d.user_id = u.user_id
            LEFT JOIN orders o ON d.order_id = o.order_id";
    
    $params = [];
    $conditions = [];
    
    if ($status) {
        $conditions[] = "d.delivery_status = :status";
        $params[':status'] = $status;
    }
    
    if ($search) {
        $conditions[] = "(u.first_name LIKE :search OR u.last_name LIKE :search OR o.order_details LIKE :search OR d.delivery_id LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if ($conditions) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }
    
    $sql .= " ORDER BY d.delivery_id DESC LIMIT :limit OFFSET :offset";
    
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get total count for pagination
    $countSql = "SELECT COUNT(*) FROM deliveries d LEFT JOIN users u ON d.user_id = u.user_id LEFT JOIN orders o ON d.order_id = o.order_id";
    if ($conditions) {
        $countSql .= " WHERE " . implode(' AND ', $conditions);
    }
    
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') {
            $countStmt->bindValue($key, $value);
        }
    }
    $countStmt->execute();
    $total = $countStmt->fetchColumn();
    
    echo json_encode([
        'success' => true,
        'data' => $deliveries,
        'total' => (int)$total
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>