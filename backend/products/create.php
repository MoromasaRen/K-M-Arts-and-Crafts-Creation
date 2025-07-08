<?php
require_once('../config/database.php');

$data = json_decode(file_get_contents("php://input"));

$sql = "INSERT INTO products (product_name, product_description, base_price) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$success = $stmt->execute([$data->name, $data->description, $data->price]);

echo json_encode(['success' => $success]);
?>
