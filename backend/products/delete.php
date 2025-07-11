require_once('../config/database.php');
$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
$success = $stmt->execute([$data->product_id]);

echo json_encode(['success' => $success]);
