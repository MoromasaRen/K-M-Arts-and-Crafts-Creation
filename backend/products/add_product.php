<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = trim($_POST['product_id'] ?? '');
    $product_name = trim($_POST['product_name'] ?? '');
    $product_description = trim($_POST['product_description'] ?? '');
    $base_price = floatval($_POST['base_price'] ?? 0);
    $status = trim($_POST['status'] ?? '');

    if ($product_id && $product_name && $status) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO products (product_id, product_name, product_description, base_price, status)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$product_id, $product_name, $product_description, $base_price, $status]);

            // ✅ Redirect with success message
            header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Product%20added%20successfully&type=success");
            exit;

        } catch (PDOException $e) {
            header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Database%20error:%20" . urlencode($e->getMessage()) . "&type=error");
            exit;
        }
    } else {
        header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Missing%20required%20fields&type=error");
        exit;
    }
} else {
    header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Invalid%20request&type=error");
    exit;
}
?>
