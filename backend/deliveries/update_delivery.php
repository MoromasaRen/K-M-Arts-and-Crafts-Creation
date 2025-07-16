<?php
require_once '../../backend/config/database.php';

$data = $_POST;
$fields = ['delivery_id','order_id','staff_id','scheduled_time','delivery_status','courier_type','plate_number'];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($data['delivery_id'])) throw new Exception("Missing delivery_id");

    $set = [];
    foreach ($fields as $f) {
        if ($f === 'delivery_id') continue;
        $set[] = "$f = :$f";
    }

    $sql = "UPDATE deliveries SET " . implode(', ', $set) . " WHERE delivery_id = :delivery_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':delivery_id', $data['delivery_id']);
    foreach ($fields as $f) {
        if ($f === 'delivery_id') continue;
        $stmt->bindValue(':' . $f, $data[$f] ?? null);
    }
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}