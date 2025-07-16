<?php
require_once '../../backend/products/fetch_products.php';

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sortOrder = isset($_GET['sort']) ? trim($_GET['sort']) : 'asc';

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$limit = 10; // items per page
$offset = ($page - 1) * $limit;

// Get total count of matching products for pagination
$totalProducts = fetchProductsCount($searchTerm, $statusFilter);
$totalPages = ceil($totalProducts / $limit);

// Fetch paginated products
$products = fetchProducts($searchTerm, $statusFilter, $sortOrder, $limit, $offset);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap");
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>
<body class="bg-[#d3e1f9] min-h-screen flex">
  <aside class="bg-white w-[350px] flex flex-col p-6">
    <div class="mb-6">
      <img alt="Logo" class="w-[300px] h-[100px] object-contain" src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" />
    </div>
    <div class="flex items-center space-x-4 mb-4">
      <img alt="User profile" class="w-20 h-20 rounded-full" src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg" />
      <div class="text-lg font-bold leading-tight">
        <p id="admin-role" class="text-[#0f2e4d]">Admin</p>
        <p id="admin-name" class="text-[#0f2e4d]">Username</p>
        <div class="flex items-center space-x-1 text-xs font-normal">
          <span class="w-3 h-3 rounded-full bg-lime-500 inline-block"></span>
          <span class="text-[#0f2e4d]">Status: <span class="font-normal">Online</span></span>
        </div>
      </div>
    </div>
    <hr class="border-gray-500 mb-6" />

    <nav class="flex flex-col space-y-3 text-lg font-bold text-[#0f2e4d] tracking-wide">
      <div class="pl-1 py-1 px-2 rounded text-[#0f2e4d]">Menu</div>
      <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100" href="Dashboard.html">Dashboard</a>
      <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100" href="Order.php">Orders</a>
      <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100" href="Delivery.php">Deliveries</a>
      <a class="pl-4 py-1 px-2 rounded bg-blue-100" href="Inventory.php">Inventory</a>
      <a class="mt-6 py-1 px-2 rounded hover:bg-blue-100" href="Profile.html">Profile</a>
    </nav>
  </aside>

  <main class="flex-1 p-6 relative">
    <div class="flex items-center mb-4 text-[#0f2e4d]">
      <button aria-label="Menu" class="text-2xl mr-3">
        <i class="fas fa-bars"></i>
      </button>
      <h2 class="font-extrabold text-lg border-b border-[#0f2e4d] pb-1">Inventory</h2>
    </div>
    
    <div class="mb-4 flex items-center space-x-4">
    <form method="GET" action="Inventory.php" class="flex items-center space-x-2 flex-grow">
  <input
    type="text"
    name="search"
    placeholder="Search by product name..."
    value="<?= htmlspecialchars($searchTerm) ?>"
    class="px-3 py-1 rounded border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 flex-grow"
  />
  
  <!-- Status Filter Dropdown -->
  <select name="status" class="px-3 py-1 rounded border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
    <option value="" <?= $statusFilter === '' ? 'selected' : '' ?>>All Status</option>
    <option value="In Stock" <?= $statusFilter === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
    <option value="Low Stock" <?= $statusFilter === 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
    <option value="No Stock" <?= $statusFilter === 'No Stock' ? 'selected' : '' ?>>No Stock</option>
  </select>

  <input type="hidden" name="sort" value="<?= htmlspecialchars($sortOrder) ?>" />
  
  <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm font-medium">Search</button>
</form>

      <div class="flex space-x-2 text-sm font-semibold text-[#0f2e4d]">
        <span>Sort by Price:</span>
        <a
          href="Inventory.php?<?= http_build_query(['search' => $searchTerm, 'status' => $statusFilter, 'sort' => 'asc']) ?>"
          class="px-3 py-1 rounded <?= $sortOrder === 'asc' ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>"
        >
          Asc
        </a>
        <a
          href="Inventory.php?<?= http_build_query(['search' => $searchTerm, 'status' => $statusFilter, 'sort' => 'desc']) ?>"
          class="px-3 py-1 rounded <?= $sortOrder === 'desc' ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>"
        >
          Desc
        </a>
      </div>
    </div>

    <table class="w-full bg-white rounded-md shadow-md text-sm text-[#0f2e4d] border-separate border-spacing-1 mt-6">
      <thead>
        <tr>
          <th class="text-left font-extrabold px-2 py-1 rounded-tl-md">Product ID</th>
          <th class="text-left font-extrabold px-2 py-1">Product Name</th>
          <th class="text-left font-extrabold px-2 py-1">Status</th>
          <th class="text-left font-extrabold px-2 py-1">
            <a href="Inventory.php?<?= http_build_query(['search' => $searchTerm, 'status' => $statusFilter, 'sort' => $sortOrder === 'asc' ? 'desc' : 'asc']) ?>"
              class="inline-flex items-center space-x-1 hover:underline">
              <span>Price</span>
              <?php if ($sortOrder === 'asc'): ?>
                <i class="fas fa-arrow-up text-xs"></i>
              <?php elseif ($sortOrder === 'desc'): ?>
                <i class="fas fa-arrow-down text-xs"></i>
              <?php endif; ?>
            </a>
          </th>
          <th class="text-left font-extrabold px-2 py-1 rounded-tr-md">Description</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($products)) : ?>
          <?php foreach ($products as $product) : ?>
            <tr class="border-t border-gray-200 h-10">
              <td class="px-2 py-1"><?= htmlspecialchars($product['product_id']) ?></td>
              <td class="px-2 py-1"><?= htmlspecialchars($product['product_name']) ?></td>
              <td class="px-2 py-1"><?= htmlspecialchars($product['status']) ?></td>
              <td class="px-2 py-1"><?= htmlspecialchars($product['base_price']) ?></td>
              <td class="px-2 py-1"><?= htmlspecialchars($product['product_description']) ?></td>
              <td class="px-4 py-2 text-right align-middle">
                <div class="inline-flex gap-2 items-center justify-end">
                  <button
                    class="editBtn text-blue-600 hover:underline text-xs font-semibold"
                    data-id="<?= htmlspecialchars($product['product_id']) ?>"
                    data-name="<?= htmlspecialchars($product['product_name']) ?>"
                    data-status="<?= htmlspecialchars($product['status']) ?>"
                    data-price="<?= htmlspecialchars($product['base_price']) ?>"
                    data-description="<?= htmlspecialchars($product['product_description']) ?>"
                  >
                    Edit
                  </button>

                  <form
                    method="POST"
                    action="/K-M-Arts-and-Crafts-Creation/backend/products/delete_product.php"
                    class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this product?');"
                  >
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>" />
                    <button type="submit" class="text-red-600 hover:underline text-xs font-semibold">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="6" class="text-center py-4 text-gray-500">No products found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    
    <div class="fixed bottom-4 left-[375px] z-50">
      <button id="editFormBtn" class="bg-lime-500 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md">Create Product</button>
    </div>

    <div id="manageModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
      <form action="/K-M-Arts-and-Crafts-Creation/backend/products/add_product.php" method="POST" class="bg-[#d7e4ff] rounded-lg p-6 shadow-md w-[360px] relative">
        <button id="closeModalBtn" type="button" class="absolute top-2 right-2 text-[#0f2e4d] text-xl font-bold">&times;</button>
        <h3 class="bg-[#a9c5ff] rounded-md px-3 py-1 font-extrabold text-[15px] mb-4 inline-block">Manage Inventory</h3>
        <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-[13px] font-extrabold text-[#1e2f4a]">
          <label class="flex flex-col gap-1">
            Product ID
            <input name="product_id" id="product_id" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="text" required />
          </label>
          <label class="flex flex-col gap-1">
            Product Name
            <input name="product_name" id="product_name" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="text" required />
          </label>
          <label class="flex flex-col gap-1">
            Status
            <input name="status" id="status" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="text" required />
          </label>
          <label class="flex flex-col gap-1">
            Price
            <input name="base_price" id="base_price" class="rounded-md border px-2 py-1 text-[13px] font-normal" type="number" step="0.01" required />
          </label>
          <label class="flex flex-col gap-1 col-span-2">
            Notes
            <input name="product_description" id="product_description" class="rounded-md border px-2 py-1 text-[13px] font-normal w-full" type="text" required />
          </label>
        </div>
        <div class="mt-4 space-x-3 text-center">
          <button type="submit" class="bg-lime-400 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md">Save</button>
        </div>
      </form>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const editFormBtn = document.getElementById("editFormBtn");
        const manageModal = document.getElementById("manageModal");
        const closeModalBtn = document.getElementById("closeModalBtn");

        const productIdInput = document.getElementById("product_id");
        const productNameInput = document.getElementById("product_name");
        const statusInput = document.getElementById("status");
        const basePriceInput = document.getElementById("base_price");
        const descriptionInput = document.getElementById("product_description");

        editFormBtn.addEventListener("click", () => {
          clearForm();
          manageModal.classList.remove("hidden");
        });

        closeModalBtn.addEventListener("click", () => manageModal.classList.add("hidden"));
        manageModal.addEventListener("click", event => {
          if (event.target === manageModal) {
            manageModal.classList.add("hidden");
          }
        });

        document.querySelectorAll(".editBtn").forEach(button => {
          button.addEventListener("click", () => {
            productIdInput.value = button.dataset.id;
            productNameInput.value = button.dataset.name;
            statusInput.value = button.dataset.status;
            basePriceInput.value = button.dataset.price;
            descriptionInput.value = button.dataset.description;

            manageModal.classList.remove("hidden");
          });
        });

        function clearForm() {
          productIdInput.value = '';
          productNameInput.value = '';
          statusInput.value = '';
          basePriceInput.value = '';
          descriptionInput.value = '';
        }
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
            }
          })
          .catch(() => {
            document.getElementById("admin-role").textContent = "";
            document.getElementById("admin-name").textContent = "";
          });
      });
    </script>
  </main>
</body>
</html>
