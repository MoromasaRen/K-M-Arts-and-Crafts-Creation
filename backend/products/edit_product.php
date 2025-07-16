<?php
require_once '../config/database.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = trim($_POST['product_id'] ?? '');
    $product_name = trim($_POST['product_name'] ?? '');
    $product_description = trim($_POST['product_description'] ?? '');
    $base_price = floatval($_POST['base_price'] ?? 0);
    $product_quantity = (int)($_POST['product_quantity'] ?? 0);
    
    // Calculate status based on quantity
    $status = calculateStatus($product_quantity);

    if ($product_id && $product_name && $product_quantity >= 0) {
        try {
            // Update existing product
            $stmt = $pdo->prepare("
                UPDATE products 
                SET product_name = ?, product_description = ?, base_price = ?, product_quantity = ?, status = ?
                WHERE product_id = ?
            ");
            $stmt->execute([$product_name, $product_description, $base_price, $product_quantity, $status, $product_id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Product%20updated%20successfully&type=success");
                exit;
            } else {
                header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Product%20not%20found%20or%20no%20changes%20made&type=error");
                exit;
            }

        } catch (PDOException $e) {
            header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Database%20error:%20" . urlencode($e->getMessage()) . "&type=error");
            exit;
        }
    } else {
        $missingFields = [];
        if (!$product_id) $missingFields[] = 'Product ID';
        if (!$product_name) $missingFields[] = 'Product Name';
        if ($product_quantity < 0) $missingFields[] = 'Valid Quantity';
        
        $errorMessage = 'Missing required fields: ' . implode(', ', $missingFields);
        header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=" . urlencode($errorMessage) . "&type=error");
        exit;
    }
} else {
    header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php?message=Invalid%20request&type=error");
    exit;
}
?>