<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $stmt = $pdo->prepare("
      UPDATE orders
      SET user_id = :user_id,
          order_details = :order_details,
          order_date = :order_date,
          total_amount = :total_amount,
          status = :status
      WHERE order_id = :order_id
    ");
    $stmt->execute([
      ':user_id' => $_POST['user_id'],
      ':order_details' => $_POST['order_details'],
      ':order_date' => str_replace('T', ' ', $_POST['order_date']),
      ':total_amount' => $_POST['total_amount'],
      ':status' => $_POST['status'],
      ':order_id' => $_POST['order_id']
    ]);

    echo json_encode(['success' => true]);
  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
  }

  $order_date = str_replace('T', ' ', $_POST['order_date']);

}