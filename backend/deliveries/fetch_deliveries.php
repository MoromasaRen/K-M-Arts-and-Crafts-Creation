<?php
header('Content-Type: application/json');

require_once '../../backend/config/database.php';

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 15;
$offset = ($page - 1) * $limit;

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // total count
    $stmt = $pdo->query("SELECT COUNT(*) FROM deliveries");
    $total = (int)$stmt->fetchColumn();

    // fetch paginated
    $stmt = $pdo->prepare("SELECT * FROM deliveries ORDER BY scheduled_time DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'total' => $total, 'data' => $rows]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
