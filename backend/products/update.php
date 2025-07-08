require_once('../config/database.php');
$data = json_decode(file_get_contents("php://input"));

$sql = "UPDATE products SET product_name = ?, product_description = ?, base_price = ?, status = ? WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$success = $stmt->execute([$data->name, $data->description, $data->price, $data->status, $data->id]);

echo json_encode(['success' => $success]);
