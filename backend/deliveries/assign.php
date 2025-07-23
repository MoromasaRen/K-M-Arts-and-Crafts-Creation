<?php
require_once('../config/database.php');

$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("INSERT INTO deliveries (orders.order_details, scheduled_time, courier_type, plate_number) VALUES (?, ?, ?, ?)");
$success = $stmt->execute([
    $data->order_details,
    $data->scheduled_time,
    $data->courier_type,
    $data->plate_number
]);

echo json_encode(['success' => $success]);
?>