<?php
require_once '../../backend/config/database.php';

try {
  $stmt = $pdo->query("SELECT * FROM products");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $products = [];
  $error = "Error fetching products: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#d3e1f9] min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-[350px] flex flex-col p-6">
    <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" class="w-[300px] h-[100px] object-contain mb-6" alt="Logo" />
    <div class="flex items-center mb-4 space-x-4">
      <img src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg" class="w-20 h-20 rounded-full" alt="User profile" />
      <div>
        <p class="text-[#0f2e4d] font-bold text-lg">Admin</p>
        <p class="text-[#0f2e4d] text-xs">Status: <span class="text-lime-500 font-medium">Online</span></p>
      </div>
    </div>
    <hr class="border-gray-500 mb-6" />
    <nav class="space-y-3 text-lg font-bold text-[#0f2e4d]">
      <a href="Dashboard.html" class="hover:bg-blue-100 px-2 py-1 rounded block">Dashboard</a>
      <a href="Order.html" class="hover:bg-blue-100 px-2 py-1 rounded block">Orders</a>
      <a href="Delivery.html" class="hover:bg-blue-100 px-2 py-1 rounded block">Deliveries</a>
      <a href="Inventory.php" class="bg-blue-100 px-2 py-1 rounded block">Inventory</a>
      <a href="Profile.html" class="hover:bg-blue-100 mt-6 px-2 py-1 rounded block">Profile</a>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-[#0f2e4d] text-xl font-extrabold">Inventory</h2>
      <button
        onclick="openModal()"
        class="bg-blue-500 text-white font-bold text-sm rounded px-4 py-2 shadow-md"
      >
        + Add Product
      </button>
    </div>

    <table class="w-full bg-white rounded shadow text-sm text-[#0f2e4d]">
      <thead>
        <tr>
          <th class="text-left px-3 py-2">Product ID</th>
          <th class="text-left px-3 py-2">Name</th>
          <th class="text-left px-3 py-2">Status</th>
          <th class="text-left px-3 py-2">Price</th>
          <th class="text-left px-3 py-2">Description</th>
          <th class="text-left px-3 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($products)): ?>
          <?php foreach ($products as $product): ?>
            <tr class="border-t border-gray-200">
              <td class="px-3 py-2"><?= htmlspecialchars($product['product_id']) ?></td>
              <td class="px-3 py-2"><?= htmlspecialchars($product['product_name']) ?></td>
              <td class="px-3 py-2"><?= htmlspecialchars($product['status']) ?></td>
              <td class="px-3 py-2"><?= htmlspecialchars($product['base_price']) ?></td>
              <td class="px-3 py-2"><?= htmlspecialchars($product['product_description']) ?></td>
              <td class="px-3 py-2 space-x-2">
                <button
                  onclick='editProduct(<?= json_encode($product) ?>)'
                  class="bg-amber-400 text-white px-3 py-1 rounded text-xs"
                >Edit</button>
                <form action="../../backend/products/delete_product.php" method="POST" class="inline">
                  <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                  <button
                    type="submit"
                    onclick="return confirm('Are you sure you want to delete this product?');"
                    class="bg-rose-500 text-white px-3 py-1 rounded text-xs"
                  >Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center py-4 text-gray-500">No products found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Modal -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
      <form
        id="productForm"
        action="../../backend/products/add_product.php"
        method="POST"
        class="bg-white rounded-lg p-6 shadow w-[360px] relative"
      >
        <button type="button" onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 font-bold text-lg">&times;</button>
        <h3 class="text-lg font-bold mb-4" id="modalTitle">Add Product</h3>

        <label class="block text-sm font-medium">Product ID
          <input type="text" name="product_id" id="product_id" required class="w-full mt-1 border px-3 py-1 rounded" />
        </label>

        <label class="block mt-3 text-sm font-medium">Product Name
          <input type="text" name="product_name" id="product_name" required class="w-full mt-1 border px-3 py-1 rounded" />
        </label>

        <label class="block mt-3 text-sm font-medium">Status
          <input type="text" name="status" id="status" required class="w-full mt-1 border px-3 py-1 rounded" />
        </label>

        <label class="block mt-3 text-sm font-medium">Price
          <input type="number" name="base_price" id="base_price" step="0.01" class="w-full mt-1 border px-3 py-1 rounded" />
        </label>

        <label class="block mt-3 text-sm font-medium">Description
          <input type="text" name="product_description" id="product_description" class="w-full mt-1 border px-3 py-1 rounded" />
        </label>

        <div class="mt-4 flex justify-end">
          <button type="submit" class="bg-lime-500 text-white px-4 py-2 rounded">Save</button>
        </div>
      </form>
    </div>

    <script>
      function openModal() {
        document.getElementById('modalTitle').textContent = 'Add Product';
        document.getElementById('productForm').action = '../../backend/products/add_product.php';
        document.getElementById('product_id').readOnly = false;
        document.getElementById('productForm').reset();
        document.getElementById('productModal').classList.remove('hidden');
        document.getElementById('productModal').classList.add('flex');
      }

      function closeModal() {
        document.getElementById('productModal').classList.remove('flex');
        document.getElementById('productModal').classList.add('hidden');
      }

      function editProduct(product) {
        document.getElementById('modalTitle').textContent = 'Edit Product';
        document.getElementById('productForm').action = '../../backend/products/update_product.php';
        document.getElementById('product_id').value = product.product_id;
        document.getElementById('product_id').readOnly = true;
        document.getElementById('product_name').value = product.product_name;
        document.getElementById('status').value = product.status;
        document.getElementById('base_price').value = product.base_price;
        document.getElementById('product_description').value = product.product_description;
        document.getElementById('productModal').classList.remove('hidden');
        document.getElementById('productModal').classList.add('flex');
      }
    </script>
  </main>
</body>
</html>
