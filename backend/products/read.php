require_once('../config/database.php');
$stmt = $conn->query("SELECT * FROM products WHERE status = 'active'");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));