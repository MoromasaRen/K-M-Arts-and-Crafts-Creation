<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

require __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email)) {
    echo json_encode(['success' => false, 'message' => 'Email required']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$data->email]);

if ($stmt->rowCount() > 0) {
    // Here, you should send an email or create a password reset token in production
    echo json_encode(['success' => true, 'message' => 'Reset link sent']);
} else {
    echo json_encode(['success' => false, 'message' => 'Email not found']);
}
