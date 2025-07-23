<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 15;
$offset = ($page - 1) * $limit;
$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    // Base query
    $sql = "SELECT d.*, o.order_details, CONCAT('Order #', o.order_id, ' - ', o.order_details) as order_info 
            FROM deliveries d 
            LEFT JOIN orders o ON d.order_id = o.order_id
            WHERE 1=1";
    $countSql = "SELECT COUNT(*) as total FROM deliveries d 
                 LEFT JOIN orders o ON d.order_id = o.order_id 
                 WHERE 1=1";

    // Add status filter if provided
    if ($status !== '') {
        $sql .= " AND d.delivery_status = :status";
        $countSql .= " AND d.delivery_status = :status";
    }

    // Add search if provided
    if ($search !== '') {
        $sql .= " AND (d.delivery_id LIKE :search1 OR d.plate_number LIKE :search2 OR o.order_details LIKE :search3)";
        $countSql .= " AND (d.delivery_id LIKE :search1 OR d.plate_number LIKE :search2)";
    }

    // Get total count
    $stmt = $pdo->prepare($countSql);
    
    // Bind parameters for count query
    if ($status !== '') {
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    }
    if ($search !== '') {
        $searchParam = "%$search%";
        $stmt->bindValue(':search1', $searchParam, PDO::PARAM_STR);
        $stmt->bindValue(':search2', $searchParam, PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $totalCount = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Add pagination
    $sql .= " ORDER BY d.delivery_id DESC LIMIT :limit OFFSET :offset";

    // Get paginated results
    $stmt = $pdo->prepare($sql);
    
    // Bind all parameters
    if ($status !== '') {
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    }
    if ($search !== '') {
        $searchParam = "%$search%";
        $stmt->bindValue(':search1', $searchParam, PDO::PARAM_STR);
        $stmt->bindValue(':search2', $searchParam, PDO::PARAM_STR);
        $stmt->bindValue(':search3', $searchParam, PDO::PARAM_STR);
    }
    
    // Bind pagination parameters as integers
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $deliveries,
        'total' => $totalCount,
        'page' => $page,
        'limit' => $limit
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
