<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->user_id) || !isset($data->items) || !isset($data->order_details) || !isset($data->total_amount)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

try {
    // Insert into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_details, total_amount, status) VALUES (?, ?, ?, 'pending')");
    $stmt->execute([$data->user_id, $data->order_details, $data->total_amount]);
    $order_id = $pdo->lastInsertId();

    // Insert each item into order_items table
    foreach ($data->items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, total_units) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $order_id,
            $item->product_id,
            $item->quantity,
            $item->price,
            $item->total_units
        ]);
    }

    echo json_encode(['success' => true, 'order_id' => $order_id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>