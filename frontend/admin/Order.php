<?php
require_once '../../backend/config/database.php';

function fetchOrders(PDO $pdo, int $limit, int $offset, ?string $search = '', ?string $status = '', ?string $startDate = '', ?string $endDate = ''): array {
  try {
      $query = "
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
          WHERE 1
      ";
      
      if ($search) {
          $query .= " AND o.user_id LIKE :search";  // Only search by user_id
      }
      
      if ($status) {
          $query .= " AND o.status = :status";
      }
      
      if ($startDate && $endDate) {
          $query .= " AND o.order_date BETWEEN :startDate AND :endDate";
      }

      $query .= " ORDER BY o.order_date DESC LIMIT :limit OFFSET :offset";

      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      
      if ($search) {
          $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
      }
      
      if ($status) {
          $stmt->bindValue(':status', $status, PDO::PARAM_STR);
      }
      
      if ($startDate && $endDate) {
          $stmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
          $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
      }

      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "❌ Error fetching orders: " . $e->getMessage();
      return [];
  }
}

function countOrders(PDO $pdo, ?string $search = '', ?string $status = '', ?string $startDate = '', ?string $endDate = ''): int {
    try {
        $query = "SELECT COUNT(*) FROM orders o LEFT JOIN order_items oi ON o.order_id = oi.order_id WHERE 1";
        
        if ($search) {
            $query .= " AND (o.order_id LIKE :search OR o.user_id LIKE :search OR o.order_details LIKE :search)";
        }

        if ($status) {
            $query .= " AND o.status = :status";
        }
        
        if ($startDate && $endDate) {
            $query .= " AND o.order_date BETWEEN :startDate AND :endDate";
        }

        $stmt = $pdo->prepare($query);
        
        if ($search) {
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }

        if ($status) {
            $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        }
        
        if ($startDate && $endDate) {
            $stmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
            $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
        }

        $stmt->execute();
        return (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "❌ Error counting orders: " . $e->getMessage();
        return 0;
    }
}

// Pagination and filtering settings
$limit = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get filter inputs from the form
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$totalOrders = countOrders($pdo, $search, $status, $startDate, $endDate);
$totalPages = ceil($totalOrders / $limit);

$orders = fetchOrders($pdo, $limit, $offset, $search, $status, $startDate, $endDate);
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
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Delivery.php">Deliveries</a>
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

  <!-- Search and Filter Form -->
  <form class="flex space-x-4 mb-6" method="GET">
  <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by User ID" class="px-3 py-2 border rounded-md w-1/3">
  <select name="status" class="px-3 py-2 border rounded-md w-1/3">
    <option value="">All Statuses</option>
    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
    <option value="confirmed" <?= $status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
  </select>
  <input type="date" name="start_date" value="<?= htmlspecialchars($startDate) ?>" class="px-3 py-2 border rounded-md">
  <input type="date" name="end_date" value="<?= htmlspecialchars($endDate) ?>" class="px-3 py-2 border rounded-md">
  <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
  <!-- Clear Filters Button -->
  <a href="Order.php" class="px-3 py-2 bg-gray-300 hover:bg-gray-400 text-[#0f2e4d] text-sm font-semibold rounded">
    Clear Filters
  </a>
</form>


  <table class="w-full bg-white rounded-md shadow-md text-sm text-[#0f2e4d] border-separate border-spacing-1 mt-6">
    <thead>
      <tr>
        <th class="text-left font-extrabold px-2 py-1 rounded-tl-md">User ID</th>
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
            <td class="px-2 py-1"><?= htmlspecialchars($order['user_id']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_details']) ?></td>
            <td class="px-2 py-1"><?= htmlspecialchars($order['order_date']) ?></td>
            <td class="px-2 py-1">₱<?= number_format($order['total_amount'], 2) ?></td>
            <td class="px-2 py-1 capitalize"><?= htmlspecialchars($order['status']) ?></td>
<td class="px-2 py-1 text-center space-x-2">
<button 
  class="text-blue-600 hover:underline text-xs edit-btn" 
  data-id="<?= $order['order_id'] ?>"
  data-userid="<?= htmlspecialchars($order['user_id']) ?>"
  data-details="<?= htmlspecialchars($order['order_details']) ?>"
  data-date="<?= htmlspecialchars($order['order_date']) ?>"
  data-amount="<?= $order['total_amount'] ?>"
  data-status="<?= htmlspecialchars($order['status']) ?>"
>Edit</button>
  <button 
    class="text-red-600 hover:underline text-xs delete-btn" 
    data-id="<?= $order['order_id'] ?>">
    Delete
  </button>
</td>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" class="text-center py-4">No orders found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  
<!-- Edit Order Modal -->
<div id="manageOrderModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
  <form id="orderForm" action="../../backend/orders/update_order.php" method="POST" class="bg-[#d7e4ff] rounded-lg p-6 shadow-md w-[360px] relative">
    <button id="closeOrderModalBtn" type="button" class="absolute top-2 right-2 text-[#0f2e4d] text-xl font-bold">&times;</button>
    <h3 id="modalOrderTitle" class="bg-[#a9c5ff] rounded-md px-3 py-1 font-extrabold text-[15px] mb-4 inline-block">Edit Order</h3>

    <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-[13px] font-extrabold text-[#1e2f4a]">
      <input type="hidden" name="order_id" id="order_id" />

      <label class="flex flex-col gap-1 col-span-2">
        User ID
        <input name="user_id" id="user_id" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="text" required />
      </label>

      <label class="flex flex-col gap-1 col-span-2">
        Order Details
        <textarea name="order_details" id="order_details" class="rounded-md border px-2 py-1 text-[13px] font-normal w-full" rows="2" required></textarea>
      </label>

      <label class="flex flex-col gap-1 col-span-2">
        Order Date
        <input name="order_date" id="order_date" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="datetime-local" required />
      </label>

      <label class="flex flex-col gap-1">
        Total
        <input name="total_amount" id="total_amount" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="number" step="0.01" required />
      </label>

      <label class="flex flex-col gap-1">
        Status
        <select name="status" id="status" class="rounded-md border px-2 py-1 text-[13px] font-normal">
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
          <option value="completed">Completed</option>
        </select>
      </label>
    </div>

    <div class="mt-4 text-center space-x-3">
      <button type="submit" class="bg-lime-400 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md">Save</button>
    </div>
  </form>
</div>


<!-- Pagination Controls -->
<div class="mt-4 flex justify-center space-x-2 text-[#0f2e4d]">
  <?php
    $queryParams = [
      'search' => $search ?? '',
      'status' => $status ?? '',
      'start_date' => $startDate ?? '',
      'end_date' => $endDate ?? ''
    ];
  ?>

  <?php if ($page > 1): ?>
    <a href="?<?= http_build_query(array_merge($queryParams, ['page' => $page - 1])) ?>"
       class="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600">
      Previous
    </a>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?<?= http_build_query(array_merge($queryParams, ['page' => $i])) ?>"
       class="px-3 py-1 rounded <?= $i === $page ? 'bg-blue-700 text-white' : 'bg-blue-100 hover:bg-blue-200' ?>">
      <?= $i ?>
    </a>
  <?php endfor; ?>

  <?php if ($page < $totalPages): ?>
    <a href="?<?= http_build_query(array_merge($queryParams, ['page' => $page + 1])) ?>"
       class="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600">
      Next
    </a>
  <?php endif; ?>
</div>


</main>

<script>

  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const orderId = this.dataset.id;

      if (confirm(`Are you sure you want to delete order #${orderId}?`)) {
        fetch('../../backend/orders/delete_order.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `order_id=${encodeURIComponent(orderId)}`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert("Order deleted successfully.");
            location.reload();
          } else {
            alert("Failed to delete order: " + data.error);
          }
        })
        .catch(() => alert("Error deleting order."));
      }
    });
  });
  // Order Modal logic
const orderModal = document.getElementById("manageOrderModal");
const orderForm = document.getElementById("orderForm");
const closeOrderModalBtn = document.getElementById("closeOrderModalBtn");

document.querySelectorAll(".edit-btn").forEach(btn => {
  btn.addEventListener("click", () => {
    document.getElementById("order_id").value = btn.dataset.id;
    document.getElementById("user_id").value = btn.dataset.userid;
    document.getElementById("order_details").value = btn.dataset.details;
    const dateOnly = btn.dataset.date.split(':').slice(0, 2).join(':'); // removes seconds
document.getElementById("order_date").value = dateOnly.replace(" ", "T");
    document.getElementById("total_amount").value = btn.dataset.amount;
    document.getElementById("status").value = btn.dataset.status;

    orderModal.classList.remove("hidden");
  });
});

closeOrderModalBtn.addEventListener("click", () => {
  orderModal.classList.add("hidden");
});

// Handle update via fetch
orderForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(orderForm);

  fetch(orderForm.action, {
    method: "POST",
    body: new URLSearchParams(formData),
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("Order updated successfully!");
        location.reload();
      } else {
        alert("Failed to update order: " + data.error);
      }
    })
    .catch(() => alert("Error updating order."));
});

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
