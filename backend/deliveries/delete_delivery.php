<?php
header('Content-Type: application/json');
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['delivery_id'] ?? null;
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['delivery_id'] ?? null;

    if (!$id) {
        echo json_encode(['success' => false, 'error' => 'Missing delivery ID']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM deliveries WHERE delivery_id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>