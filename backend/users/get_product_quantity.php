<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    $stmt = $pdo->prepare("SELECT product_quantity FROM products WHERE product_id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode(['quantity' => $product['product_quantity']]);
    } else {
        echo json_encode(['quantity' => 0]);
    }
} else {
    echo json_encode(['error' => 'No product_id provided']);
}
?>
