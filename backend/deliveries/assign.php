<?php
require_once('../config/database.php');

$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("INSERT INTO deliveries (order_id, staff_id, scheduled_time, courier_type, plate_number) VALUES (?, ?, ?, ?, ?)");
$success = $stmt->execute([
    $data->order_id,
    $data->staff_id,
    $data->scheduled_time,
    $data->courier_type,
    $data->plate_number
]);

echo json_encode(['success' => $success]);
?>