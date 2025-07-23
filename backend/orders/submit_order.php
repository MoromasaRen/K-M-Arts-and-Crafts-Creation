<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Read the incoming JSON
$data = json_decode(file_get_contents("php://input"));

// Validate required fields
if (
    !$data ||
    !isset($data->user_id) ||
    !isset($data->items) ||
    !isset($data->order_details) ||
    !isset($data->total_amount)
) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$user_id = $data->user_id;
$order_details = $data->order_details;
$total_amount = $data->total_amount;
$items = $data->items;

try {
    // Check if user_id exists in users table before inserting
    $userCheck = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_id = ?");
    $userCheck->execute([$user_id]);
    $userExists = $userCheck->fetchColumn();

    if ($userExists == 0) {
        echo json_encode(['success' => false, 'message' => 'User ID does not exist']);
        exit;
    }

    // Insert into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_details, total_amount, status) VALUES (?, ?, ?, 'pending')");
    $stmt->execute([$user_id, $order_details, $total_amount]);
    $order_id = $pdo->lastInsertId();

    // Insert items into order_items table
    foreach ($items as $item) {
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
