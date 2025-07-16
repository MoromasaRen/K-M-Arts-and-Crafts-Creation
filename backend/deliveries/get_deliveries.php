<?php
require_once '../config/database.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

try {
    $stmt = $pdo->prepare("SELECT * FROM deliveries ORDER BY scheduled_time DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total count
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM deliveries");
    $totalCount = $totalStmt->fetchColumn();

    echo json_encode([
        'success' => true,
        'data' => $deliveries,
        'total' => $totalCount
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
