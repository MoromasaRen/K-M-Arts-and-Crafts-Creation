<?php
require_once('../config/database.php');

$data = json_decode(file_get_contents("php://input"));

// Insert into orders
$stmt = $conn->prepare("INSERT INTO orders (user_id, order_details, total_amount) VALUES (?, ?, ?)");
$stmt->execute([$data->user_id, $data->details, $data->total]);

$order_id = $conn->lastInsertId();

// Insert order items
foreach ($data->items as $item) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, total_units) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$order_id, $item->product_id, $item->quantity, $item->price, $item->total_units]);
}

echo json_encode(['success' => true, 'order_id' => $order_id]);
?>