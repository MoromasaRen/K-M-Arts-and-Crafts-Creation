<?php
session_start();

// Optional: set timeout (15 minutes)
$timeout_duration = 900;

if (!isset($_SESSION['user_id'])) {
    // User not logged in
    header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html");
    exit;
}

// Handle timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html?timeout=1");
    exit;
}

// Update activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=League+Spartan:wght@100..900&display=swap"
      rel="stylesheet"
    />
      <style>
        body {
          font-family: "Roboto Mono", monospace;
        }

        @keyframes fadeIn {
          from {
            opacity: 0;
            transform: scale(0.95);
          }
          to {
            opacity: 1;
            transform: scale(1);
          }
        }

        .animate-fadeIn {
          animation: fadeIn 0.3s ease-out forwards;
        }

        /* Overlay for sidebar */
        .sidebar-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 20;
          opacity: 0;
          visibility: hidden;
          transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .sidebar-overlay.active {
          opacity: 1;
          visibility: visible;
          transition: opacity 0.3s ease, visibility 0.3s ease;
        }
      </style>
  </head>

  <body class="bg-[#d3e1f9] min-h-screen">
    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-white w-[350px] flex flex-col p-6 fixed h-full z-30 transition-transform duration-300 ease-in-out transform -translate-x-full shadow-lg">
      <div class="mb-6">
        <img
          src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png"
          alt="Logo K and M Arts and Crafts"
          class="w-[300px] h-[100px] object-contain"
        />
      </div>
      <div class="flex items-center space-x-4 mb-4">
        <img
          src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
          alt="User profile picture"
          class="w-20 h-20 rounded-full"
        />

        <!-- update here -->
        <div class="text-lg font-bold leading-tight">
            <p id="admin-role" class="text-[#0f2e4d]"></p>
            <p id="admin-name" class="text-[#0f2e4d]"></p>
          <div class="flex items-center space-x-1 text-xs font-normal">
            <span class="w-3 h-3 rounded-full bg-lime-500 inline-block"></span>
            <span class="text-[#0f2e4d]">Status: <span class="font-normal">Online</span></span>
          </div>
        </div>

      </div>
      <hr class="border-gray-500 mb-6" />
      <nav
        class="flex flex-col space-y-3 text-lg font-bold text-[#0f2e4d] tracking-wide"
      >
        <div class="pl-1 py-1 px-2 rounded text-[#0f2e4d]">Menu</div>

        <a
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Dashboard.php"
          class="pl-4 py-1 px-2 rounded bg-blue-100"
          >Dashboard</a
        >
        <a
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Order.php"
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          >Orders</a
        >
        <a
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Delivery.php"
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          >Deliveries</a
        >
        <a
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php"
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          >Inventory</a
        >
        <a
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Profile.php"
          class="mt-6 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          >Profile</a
        >
      </nav>
    </aside>

    <!-- Main content - Now always full width -->
    <main class="flex-1 p-6 flex flex-col gap-6 w-full transition-all duration-300">
      <!-- Top bar -->
      <div class="flex items-center gap-3 mb-2">
        <button 
          id="sidebarToggle" 
          aria-label="Menu" 
          class="text-gray-900 text-xl hover:text-blue-600 transition-colors"
          onclick="toggleSidebar()"
        >
          <i class="fas fa-bars"></i>
        </button>
        <h1
          class="font-bold text-gray-900 text-lg border-b border-[#0f2e4d] pb-1"
        >
          Dashboard
        </h1>
      </div>

      <!-- Cards -->
      <div class="flex flex-col sm:flex-row gap-4">
        <!-- Orders -->
        <div
          class="bg-white shadow-md rounded p-4 flex-1 min-w-[180px] flex flex-col items-center text-center"
        >
          <div class="mb-3">
            <div
              class="text-4xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-md"
            >
              <i class="fas fa-box-open"></i>
            </div>
          </div>
          <p class="font-semibold text-gray-900 mb-1">
            New Orders: <span id="new-orders" class="font-normal">0</span>
          </p>
        </div>

        <!-- Deliveries -->
        <div
          class="bg-white shadow-md rounded p-4 flex-1 min-w-[180px] flex flex-col items-center text-center"
        >
          <div class="mb-3">
            <div
              class="text-4xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-md"
            >
              <i class="fas fa-truck"></i>
            </div>
          </div>
          <p class="font-semibold text-gray-900 mb-1">
            Scheduled Deliveries: <span id="scheduled-deliveries" class="font-normal">0</span>
          </p>
        </div>

        <!-- Inventory -->
        <div
          class="bg-white shadow-md rounded p-4 flex-1 min-w-[180px] flex flex-col items-center text-center"
        >
          <div class="mb-3">
            <div
              class="text-4xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-md"
            >
              <i class="fas fa-warehouse"></i>
            </div>
          </div>
          <p class="font-semibold text-gray-900 mb-1">
            Inventory Status: <span id="inventory-status" class="font-normal">Loading...</span>
          </p>
        </div>
      </div>

<!-- Extra Info Cards -->
<div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
  <!-- Remaining Orders -->
  <div class="bg-white shadow-md rounded p-4 flex items-center justify-center gap-4 w-full">
    <div class="text-3xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-sm">
      <i class="fas fa-box"></i>
    </div>
    <div>
      <p class="font-semibold text-gray-900">Pending Orders</p>
      <p id="pending-orders" class="text-sm text-gray-600">0</p>
    </div>
  </div>

  <!-- Remaining Deliveries -->
  <div class="bg-white shadow-md rounded p-4 flex items-center justify-center gap-4 w-full">
    <div class="text-3xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-sm">
      <i class="fas fa-shipping-fast"></i>
    </div>
    <div>
      <p class="font-semibold text-gray-900">Deliveries In Transit</p>
      <p id="in-transit-deliveries" class="text-sm text-gray-600">0</p>
    </div>
  </div>

  <!-- Completed Orders -->
  <div class="bg-white shadow-md rounded p-4 flex items-center justify-center gap-4 w-full">
    <div class="text-3xl text-[#0f2e4d] bg-[#d3e1f9] p-4 rounded-full shadow-sm">
      <i class="fas fa-check-circle"></i>
    </div>
    <div>
      <p class="font-semibold text-gray-900">Completed Orders</p>
      <p id="completed-orders" class="text-sm text-gray-600">0</p>
    </div>
  </div>
</div>

<!-- Bottom section with Notifications and Action Buttons side by side -->
<div class="flex flex-col lg:flex-row gap-6 w-full">
  <!-- Notifications Panel -->
  <div class="bg-white shadow-md rounded p-4 w-full lg:w-2/3">
  <div class="flex justify-between items-center mb-3">
    <p class="font-semibold text-gray-900 text-lg">Latest Orders</p>
  </div>

  <!-- Notification List -->
  <ul id="notificationList" class="space-y-3 max-h-64 overflow-y-auto text-sm">
    <li class="bg-blue-50 p-3 rounded shadow-sm">
      <p class="text-gray-800">
        🛒 <strong>Order #12345</strong> placed by <strong>User_01</strong>
      </p>
      <p class="text-gray-500 text-xs">Just now</p>
    </li>
    <!-- More items dynamically added here -->
  </ul>
</div>
<!-- Action Buttons aligned to the right -->
<div class="flex flex-col gap-4 w-full lg:w-1/3">
  <a
    href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Order.php"
    class="text-blue-900 font-semibold text-lg px-6 py-4 rounded-full shadow hover:shadow-lg transition bg-white w-full text-center"
  >
    Open Orders
  </a>
  <a
    href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Delivery.php"
    class="text-blue-900 font-semibold text-lg px-6 py-4 rounded-full shadow hover:shadow-lg transition bg-white w-full text-center"
  >
    Open Deliveries
  </a>
 <a
    href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php"
    class="text-blue-900 font-semibold text-lg px-6 py-4 rounded-full shadow hover:shadow-lg transition bg-white w-full text-center"
  >
    Open Inventory
    </a>
  </div>
</div>
    </main>

    <!-- Manage Modal -->
    <div id="manageModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
      <form class="bg-[#d7e4ff] rounded-lg p-6 shadow-md w-[360px] relative transform transition-all duration-300 scale-95 opacity-0 animate-fadeIn">
        <button
          id="closeModalBtn"
          type="button"
          class="absolute top-2 right-2 text-[#0f2e4d] hover:text-gray-700 text-xl font-bold"
        >
          &times;
        </button>
        <h3
          id="manageModalTitle"
          class="bg-[#a9c5ff] rounded-md px-3 py-1 font-extrabold text-[15px] mb-4 inline-block"
        >
          Manage Order
        </h3>
        <div
          class="grid grid-cols-2 gap-x-6 gap-y-3 text-[13px] font-extrabold text-[#1e2f4a]"
        >
          <label class="flex flex-col gap-1">
            Order ID
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            Item ID
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            User ID
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            Order Details
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            Order Date
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            Total Amount
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal"
              type="text"
            />
          </label>
          <label class="flex flex-col gap-1">
            Status
            <input
              class="rounded-md border border-gray-300 px-2 py-1 text-[13px] font-normal w-full max-w-[180px]"
              type="text"
            />
          </label>
        </div>
        <div class="mt-4 space-x-3">
          <button
            type="button"
            class="bg-lime-400 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md"
          >
            Create
          </button>
          <button
            type="button"
            class="bg-amber-300 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md"
          >
            Update
          </button>
          <button
            type="button"
            class="bg-rose-400 text-white font-extrabold text-xs rounded px-3 py-1 shadow-md"
          >
            Delete
          </button>
        </div>
      </form>
    </div>
    <!-- External JavaScript -->
    <script src="/K-M-Arts-and-Crafts-Creation/frontend/admin/js/init.js"></script>
    <script src="/K-M-Arts-and-Crafts-Creation/frontend/admin/js/animations.js"></script>
    <script src="/K-M-Arts-and-Crafts-Creation/frontend/admin/js/notifications.js"></script>
  </body>
<script>
  
  function updateDashboardStats() {
    console.log('Fetching dashboard statistics...');
    fetch('/K-M-Arts-and-Crafts-Creation/backend/dashboard/get_statistics.php')
      .then(response => {
        console.log('Response status:', response.status);
        return response.json();
      })
      .then(result => {
        console.log('API Response:', result);
        if (result.success) {
          const data = result.data;
          console.log('Dashboard data:', data);
          
          // Update all statistics
          document.getElementById('new-orders').textContent = data.new_orders || 0;
          document.getElementById('scheduled-deliveries').textContent = data.scheduled_deliveries || 0;
          document.getElementById('inventory-status').textContent = data.inventory_status || 'Unknown';
          document.getElementById('pending-orders').textContent = data.pending_orders || 0;
          document.getElementById('in-transit-deliveries').textContent = data.in_transit_deliveries || 0;
          document.getElementById('completed-orders').textContent = data.completed_orders || 0;

          // Log individual values for debugging
          console.log('Individual values:', {
            new_orders: data.new_orders,
            scheduled_deliveries: data.scheduled_deliveries,
            inventory_status: data.inventory_status,
            pending_orders: data.pending_orders,
            in_transit_deliveries: data.in_transit_deliveries,
            completed_orders: data.completed_orders
          });
        } else {
          console.error('API returned success: false', result.error);
        }
      })
      .catch(error => {
        console.error('Error fetching dashboard statistics:', error);
        // Show error in dashboard for debugging
        document.getElementById('inventory-status').textContent = 'Error loading data';
      });
  }

  // Update stats every 30 seconds
  setInterval(updateDashboardStats, 30000);

  // Sidebar Toggle Function
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("sidebarOverlay");

  const isOpen = sidebar.classList.contains("translate-x-0");

  if (isOpen) {
    // Close sidebar
    sidebar.classList.remove("translate-x-0");
    sidebar.classList.add("-translate-x-full");
    overlay.classList.remove("active");
  } else {
    // Open sidebar
    sidebar.classList.remove("-translate-x-full");
    sidebar.classList.add("translate-x-0");
    overlay.classList.add("active");
  }
}

  // Close sidebar when clicking on overlay
  document.getElementById('sidebarOverlay').addEventListener('click', function() {
    toggleSidebar();
  });

  // Close sidebar when pressing Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const sidebar = document.getElementById('sidebar');
      if (sidebar.classList.contains('translate-x-0')) {
        toggleSidebar();
      }
    }
  });
document.getElementById('sidebarOverlay').addEventListener('click', function () {
  toggleSidebar();
});
  window.addEventListener("DOMContentLoaded", function () {
    // Load initial statistics
    updateDashboardStats();
    
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


</html>