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
function fetchProducts($searchTerm = '', $statusFilter = '', $sortOrder = 'asc', $limit = 10, $offset = 0) {
    global $pdo;
    
    // Updated query to include product_quantity and calculate status
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
              WHERE 1=1";
    
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
    
    $query .= " ORDER BY base_price " . ($sortOrder === 'desc' ? 'DESC' : 'ASC');
    $query .= " LIMIT :limit OFFSET :offset";
    
    $stmt = $pdo->prepare($query);
    
    // Bind params
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get total count of products matching search and status filters
 * 
 * @param string $searchTerm
 * @param string $statusFilter
 * @return int
 */
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