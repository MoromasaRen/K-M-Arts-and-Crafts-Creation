<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delivery_id'])) {
    $delivery_id = $_POST['delivery_id'];
    if (!$delivery_id) {
        echo json_encode(['success' => false, 'error' => 'Missing delivery ID']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM deliveries WHERE delivery_id = ?");
        $stmt->execute([$delivery_id]);

        header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Delivery.php?message=Delivery%20deleted&type=success");
        exit;
    } catch (PDOException $e) {
        echo "Error deleting product: " . $e->getMessage();
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>