<?php
echo password_hash("password123", PASSWORD_DEFAULT);
password_verify($inputPassword, $hashedPasswordFromDB);
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents("php://input"));

echo password_hash("12345", PASSWORD_DEFAULT);

if (!isset($data->email, $data->password)) {
    echo json_encode(['success' => false, 'message' => 'Missing credentials']);
    exit;
}

$stmt = $pdo->prepare("SELECT user_id, password, user_type, first_name, last_name FROM users WHERE email = ?");
$stmt->execute([$data->email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($data->password, $user['password'])) {
    echo json_encode([
        'success' => true,
        'user_id' => $user['user_id'],
        'user_type' => $user['user_type'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
