require_once('../config/database.php');
$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
$success = $stmt->execute([$data->status, $data->order_id]);

echo json_encode(['success' => $success]);
