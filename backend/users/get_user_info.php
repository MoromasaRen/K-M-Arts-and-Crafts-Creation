<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode([
        'success' => true,
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name']
        'email' => $user['email']
        'user_type' => $user['user_type']
        'last_name' => $user['last_name']
        'last_name' => $user['last_name']

        
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}
