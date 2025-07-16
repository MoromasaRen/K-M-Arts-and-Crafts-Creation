<?php
require_once '../../backend/config/database.php';

try {
    $stmt = $pdo->query("
        SELECT 
            o.order_id, 
            oi.order_item_id,
            o.user_id,
            o.order_details, 
            o.order_date, 
            o.total_amount, 
            o.status 
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        ORDER BY o.order_date DESC
    ");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "❌ Error fetching orders: " . $e->getMessage();
    $orders = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap");
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>
<body class="bg-[#d3e1f9] min-h-screen flex">

<!-- Sidebar -->
<aside class="bg-white w-[350px] flex flex-col p-6">
  <div class="mb-6">
    <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" alt="Logo" class="w-[300px] h-[100px] object-contain"/>
  </div>

  <div class="flex items-center space-x-4 mb-4">
    <img src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg" alt="Profile Picture" class="w-20 h-20 rounded-full"/>
    <div class="text-lg font-bold leading-tight">
      <p id="admin-role" class="text-[#0f2e4d]"></p>
      <p id="admin-name" class="text-[#0f2e4d]"></p>
      <div class="flex items-center space-x-1 text-xs font-normal">
        <span class="w-3 h-3 rounded-full bg-lime-500 inline-block"></span>
        <span class="text-[#0f2e4d]">Status: <span class="font-normal">Online</span></span>
      </div>
    </div>
  </div>

  <hr class="border-gray-500 mb-6"/>
  <nav class="flex flex-col space-y-3 text-lg font-bold text-[#0f2e4d] tracking-wide">
    <div class="pl-1 py-1 px-2 rounded text-[#0f2e4d]">Menu</div>
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Dashboard.html">Dashboard</a>
    <a class="pl-4 py-1 px-2 rounded bg-blue-100" href="Order.php">Orders</a>
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Delivery.html">Deliveries</a>
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Inventory.php">Inventory</a>
    <a class="mt-6 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Profile.html">Profile</a>
  </nav>
</aside>

<!-- Main content -->
<main class="flex-1 p-6 relative">
  <div class="flex items-center mb-4 text-[#0f2e4d]">
    <button aria-label="Menu" class="text-2xl mr-3">
      <i class="fas fa-bars"></i>
    </button>
    <h2 class="font-extrabold text-lg leading-5 border-b border-[#0f2e4d] pb-1">Orders</h2>
  </div>

  <table class="w-full bg-white rounded-md shadow-md text-sm text-[#0f2e4d] border-separate border-spacing-1 mt-6">
    <thead>
      <tr>
        <th class="text-left font-extrabold px-2 py-1 rounded-tl-md">Order ID</th>
        <th class="text-left font-extrabold px-2 py-1">Item ID</th>
        <th class="text-left font-extrabold px-2 py-1">User ID</th>
        <th class="text-left font-extrabold px-2 py-1">Order Details</th>
        <th class="text-left font-extrabold px-2 py-1">Order Date</th>
        <th class="text-left font-extrabold px-2 py-1">Total Amount</th>
        <th class="text-left font-extrabold px-2 py-1">Status</th>
        <th class="rounded-tr-md"></th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
          <tr class="border-t border-gray-200">
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_id']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_item_id']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['user_id']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_details']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_date']) ?></td>
            <td class="px-2 py-1">₱<?= number_format($order['total_amount'], 2) ?></td>
            <td class="px-2 py-1 capitalize"><?= htmlspecialchars($order['status']) ?></td>
            <td class="px-2 py-1 text-center">
              <button class="text-blue-600 hover:underline text-xs">Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="text-center py-4">No orders found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<script>
  // Fetch admin info from localStorage and backend
  window.addEventListener("DOMContentLoaded", function () {
    const userId = localStorage.getItem("user_id");

    if (!userId) {
      document.getElementById("admin-role").textContent = "";
      document.getElementById("admin-name").textContent = "";
      return;
    }

    fetch(`/K-M-Arts-and-Crafts-Creation/backend/users/get_user_info.php?user_id=${userId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          document.getElementById("admin-role").textContent = data.first_name;
          document.getElementById("admin-name").textContent = data.last_name;
        } else {
          document.getElementById("admin-role").textContent = "";
          document.getElementById("admin-name").textContent = "";
        }
      })
      .catch(() => {
        document.getElementById("admin-role").textContent = "Error";
        document.getElementById("admin-name").textContent = "Name";
      });
  });
</script>

</body>
</html>
