require_once('../config/database.php');
$data = json_decode(file_get_contents("php://input"));

$hashed = password_hash($data->password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, user_type, password, contact_number) VALUES (?, ?, ?, ?, ?, ?)");
$success = $stmt->execute([
    $data->first_name,
    $data->last_name,
    $data->email,
    $data->user_type,
    $hashed,
    $data->contact_number
]);

echo json_encode(['success' => $success]);
