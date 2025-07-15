<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->execute([$product_id]);

        // Redirect with success message (optional)
        header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Product%20deleted&type=success");
        exit;
    } catch (PDOException $e) {
        echo "❌ Error deleting product: " . $e->getMessage();
    }
} else {
    echo "❌ Invalid delete request.";
}
?>
