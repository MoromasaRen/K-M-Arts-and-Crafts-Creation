<?php
require_once '../../backend/config/database.php';

$data = $_POST;
$fields = ['delivery_id','order_id','staff_id','scheduled_time','delivery_status','courier_type','plate_number'];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $placeholders = [];
    $cols = [];
    foreach ($fields as $f) {
        if (!isset($data[$f])) throw new Exception("Missing $f");
        $cols[] = $f;
        $placeholders[] = ':' . $f;
    }

    $sql = "INSERT INTO deliveries (" . implode(',', $cols) . ") VALUES (" . implode(',', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);
    foreach ($fields as $f) {
        $stmt->bindValue(':' . $f, $data[$f]);
    }
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
