<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (
    !isset($data->first_name, $data->last_name, $data->contact_number, $data->email, $data->password, $data->user_type) ||
    empty($data->email) || empty($data->password)
) {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
    exit;
}

$hashedPassword = password_hash($data->password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, contact_number, email, password, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $data->first_name,
        $data->last_name,
        $data->contact_number,
        $data->email,
        $hashedPassword,
        $data->user_type
    ]);
    echo json_encode(['success' => true, 'message' => 'User registered successfully']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Email already exists']);
}
