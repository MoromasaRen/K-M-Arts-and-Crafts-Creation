require_once('../config/database.php');
$stmt = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
