<?php
require_once('../config/database.php');

$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$data->email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($data->password, $user['password'])) {
    echo json_encode([
        'success' => true,
        'user_id' => $user['user_id'],
        'user_type' => $user['user_type']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
?>