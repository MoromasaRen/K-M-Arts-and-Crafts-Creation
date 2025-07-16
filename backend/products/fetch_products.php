<?php
// Database connection (adjust if you use a separate file)
$host = 'localhost';
$db = 'km_arts';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

/**
 * Calculate status based on quantity
 * 
 * @param int $quantity
 * @return string
 */
function calculateStatus($quantity) {
    $qty = (int)$quantity;
    if ($qty === 0) return 'No Stock';
    if ($qty < 20) return 'Low Stock';
    return 'In Stock';
}

/**
 * Fetch products with optional search, status filter, and sorting by price
 * 
 * @param string $searchTerm
 * @param string $statusFilter
 * @param string $sortOrder - 'asc' or 'desc'
 * @param int $limit
 * @param int $offset
 * @return array
 */
function fetchProducts($searchTerm, $statusFilter, $sortOrder, $limit, $offset) {
  global $pdo;

  $query = "SELECT * FROM products WHERE 1";
  $params = [];

  if (!empty($searchTerm)) {
    $query .= " AND product_name LIKE :search";
    $params[':search'] = "%$searchTerm%";
  }

  if (!empty($statusFilter)) {
    $query .= " AND status = :status";
    $params[':status'] = $statusFilter;
  }

  // ✅ FIX: Add sort logic here
$query .= " ORDER BY base_price " . ($sortOrder === 'desc' ? 'DESC' : 'ASC');

  $query .= " LIMIT :limit OFFSET :offset";
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

  foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
  }

  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchProductsCount($searchTerm = '', $statusFilter = '') {
    global $pdo;
    
    $query = "SELECT COUNT(*) FROM products WHERE 1=1";
    $params = [];
    
    if ($searchTerm !== '') {
        $query .= " AND product_name LIKE :search";
        $params[':search'] = "%$searchTerm%";
    }
    
    if ($statusFilter !== '') {
        // Filter by calculated status
        $query .= " AND (
            CASE 
                WHEN product_quantity = 0 THEN 'No Stock'
                WHEN product_quantity < 20 THEN 'Low Stock'
                ELSE 'In Stock'
            END
        ) = :status";
        $params[':status'] = $statusFilter;
    }
    
    $stmt = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    
    return (int) $stmt->fetchColumn();
}

/**
 * Get a single product by ID
 * 
 * @param string $product_id
 * @return array|false
 */
function getProductById($product_id) {
    global $pdo;
    
    $query = "SELECT 
                product_id, 
                product_name, 
                product_description, 
                base_price, 
                product_quantity,
                CASE 
                    WHEN product_quantity = 0 THEN 'No Stock'
                    WHEN product_quantity < 20 THEN 'Low Stock'
                    ELSE 'In Stock'
                END as status
              FROM products 
              WHERE product_id = :product_id";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>