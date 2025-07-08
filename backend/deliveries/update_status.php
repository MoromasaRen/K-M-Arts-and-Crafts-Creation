require_once('../config/database.php');
$data = json_decode(file_get_contents("php://input"));

$stmt = $conn->prepare("UPDATE deliveries SET delivery_status = ?, actual_delivery_time = ? WHERE delivery_id = ?");
$success = $stmt->execute([$data->status, $data->delivered_time, $data->delivery_id]);

echo json_encode(['success' => $success]);
