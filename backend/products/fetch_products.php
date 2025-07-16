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
 * Fetch products with optional search, status filter, and sorting by price
 * 
 * @param string $searchTerm
 * @param string $statusFilter
 * @param string $sortOrder - 'asc' or 'desc'
 * 
 * @return array
 */
function fetchProducts($searchTerm = '', $statusFilter = '', $sortOrder = 'asc', $limit = 10, $offset = 0) {
    global $pdo;

    $query = "SELECT * FROM products WHERE 1=1";
    $params = [];

    if ($searchTerm !== '') {
        $query .= " AND product_name LIKE :search";
        $params[':search'] = "%$searchTerm%";
    }

    if ($statusFilter !== '') {
        $query .= " AND status = :status";
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

function fetchProductsCount($searchTerm = '', $statusFilter = '') {
    global $pdo;

    $query = "SELECT COUNT(*) FROM products WHERE 1=1";
    $params = [];

    if ($searchTerm !== '') {
        $query .= " AND product_name LIKE :search";
        $params[':search'] = "%$searchTerm%";
    }

    if ($statusFilter !== '') {
        $query .= " AND status = :status";
        $params[':status'] = $statusFilter;
    }

    $stmt = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}