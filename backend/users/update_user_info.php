<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Check if it's personal info update or address update
if (isset($data['update_type'])) {
    if ($data['update_type'] === 'personal_info') {
        updatePersonalInfo($data, $pdo);
    } elseif ($data['update_type'] === 'address_info') {
        updateAddressInfo($data, $pdo);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid update type.']);
    }
} else {
    // Legacy support - assume personal info update
    updatePersonalInfo($data, $pdo);
}

function updatePersonalInfo($data, $pdo) {
    // Basic validation for personal info
    if (
        !isset($data['user_id']) ||
        !isset($data['first_name']) ||
        !isset($data['last_name']) ||
        !isset($data['email']) ||
        !isset($data['contact_number']) ||
        !isset($data['dateofbirth'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Missing required personal info fields.']);
        return;
    }

    $user_id = $data['user_id'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $contact_number = $data['contact_number'];
    $dateofbirth = $data['dateofbirth'];

    try {
        $sql = "UPDATE users 
                SET first_name = ?, last_name = ?, email = ?, contact_number = ?, dateofbirth = ?
                WHERE user_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$first_name, $last_name, $email, $contact_number, $dateofbirth, $user_id]);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Personal information updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update personal information']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function updateAddressInfo($data, $pdo) {
    // Basic validation for address info
    if (
        !isset($data['user_id']) ||
        !isset($data['address']) ||
        !isset($data['country']) ||
        !isset($data['city']) ||
        !isset($data['postal_code'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Missing required address fields.']);
        return;
    }

    $user_id = $data['user_id'];
    $address = $data['address'];
    $country = $data['country'];
    $city = $data['city'];
    $postal_code = $data['postal_code'];

    try {
        $sql = "UPDATE users 
                SET address = ?, country = ?, city = ?, postal_code = ?
                WHERE user_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$address, $country, $city, $postal_code, $user_id]);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Address information updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update address information']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>