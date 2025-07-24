<?php
require_once '../../backend/config/database.php';

try {
    $page = (int)($_GET['page'] ?? 1);
    $limit = (int)($_GET['limit'] ?? 15);
    $offset = ($page - 1) * $limit;
    $status = $_GET['status'] ?? '';
    $search = $_GET['search'] ?? '';

    // ✅ FIXED: Updated SQL query to properly join and handle user information
    $sql = "SELECT 
                d.*,
                o.user_id as order_user_id,
                o.order_details,
                o.total_amount,
                o.status as order_status,
                u.first_name,
                u.last_name,
                CONCAT('Order #', o.order_id, ' - ', COALESCE(o.order_details, '')) as order_info,
                CASE 
                    WHEN u.user_id IS NOT NULL THEN CONCAT('#', o.user_id, ' - ', COALESCE(u.first_name, ''), ' ', COALESCE(u.last_name, ''))
                    WHEN o.user_id IS NOT NULL THEN CONCAT('#', o.user_id)
                    ELSE 'N/A'
                END as user_info
            FROM deliveries d
            LEFT JOIN orders o ON d.order_id = o.order_id
            LEFT JOIN users u ON o.user_id = u.user_id";
    
    $params = [];
    $conditions = [];
    
    if ($status) {
        $conditions[] = "d.delivery_status = :status";
        $params[':status'] = $status;
    }
    
    if ($search) {
        $conditions[] = "(
            u.first_name LIKE :search 
            OR u.last_name LIKE :search 
            OR o.order_details LIKE :search 
            OR d.delivery_id LIKE :search
            OR o.user_id LIKE :search
        )";
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
    
    // Process the results to ensure proper user_id handling
    foreach ($deliveries as &$delivery) {
        // Set user_id from order if it exists
        $delivery['user_id'] = $delivery['order_user_id'] ?? null;
        unset($delivery['order_user_id']); // Clean up temporary field
        
        // Format order info with status if available
        if ($delivery['order_status']) {
            $delivery['order_info'] .= " ({$delivery['order_status']})";
        }
    }
    unset($delivery); // Break the reference
    
    // Get total count for pagination
    $countSql = "SELECT COUNT(*) FROM deliveries d 
                 LEFT JOIN orders o ON d.order_id = o.order_id 
                 LEFT JOIN users u ON o.user_id = u.user_id";
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
    error_log("Error in fetch_deliveries.php: " . $e->getMessage());
    error_log("SQL Query: " . $sql);
    error_log("Parameters: " . print_r($params, true));
    
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch deliveries. Check server logs for details.',
        'debug' => $e->getMessage() // Only in development, remove in production
    ]);
}
?>