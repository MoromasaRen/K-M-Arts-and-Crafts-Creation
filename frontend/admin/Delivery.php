<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Deliveries</title>
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
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href= Order.php>Orders</a>
    <a class="pl-4 py-1 px-2 rounded bg-blue-100"50" href="Delivery.php">Deliveries</a>
    <a class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Inventory.php">Inventory</a>
    <a class="mt-6 py-1 px-2 rounded hover:bg-blue-100 transition duration-150" href="Profile.html">Profile</a>
  </nav>
</aside>

  <main class="flex-1 p-6 relative">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4 text-[#0f2e4d]">
      <div class="flex items-center">
        <button class="text-2xl mr-3">
          <i class="fas fa-bars"></i>
        </button>
        <h2 class="font-extrabold text-lg border-b border-[#0f2e4d] pb-1">Deliveries</h2>
      </div>
      <div class="flex items-center gap-4">
        <div class="relative">
          <input type="text" id="searchInput" placeholder="Search deliveries..." 
                 class="rounded-md px-3 py-1 pr-8 text-sm border focus:outline-none focus:border-blue-500">
          <button id="searchBtn" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <div class="flex rounded-md shadow-sm">
          <button class="status-filter px-3 py-1 text-xs font-bold border-r" data-status="scheduled">
            Scheduled
          </button>
          <button class="status-filter px-3 py-1 text-xs font-bold border-r" data-status="in_transit">
            In Transit
          </button>
          <button class="status-filter px-3 py-1 text-xs font-bold" data-status="delivered">
            Delivered
          </button>
        </div>
      </div>
    </div>

    <!-- Table -->
<table class="w-full bg-white rounded-md shadow-md text-sm text-[#0f2e4d] border-separate border-spacing-1 mt-6">
  <thead>
    <tr>
      <th class="text-left font-extrabold px-2 py-1 rounded-tl-md">Delivery ID</th>
      <th class="text-left font-extrabold px-2 py-1">User Info</th>
      <th class="text-left font-extrabold px-2 py-1">Order Details</th>
      <!-- <th class="text-left font-extrabold px-2 py-1">Staff ID</th> -->
      <th class="text-left font-extrabold px-2 py-1">Scheduled Time</th>
      <th class="text-left font-extrabold px-2 py-1">Status</th>
      <th class="text-left font-extrabold px-2 py-1">Courier</th>
      <th class="text-left font-extrabold px-2 py-1">Plate #</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

    <!-- Pagination -->
    <div id="paginationControls" class="mt-4 flex justify-center space-x-2 text-[#0f2e4d]"></div>

    <!-- Create Button -->
    <div class="fixed bottom-4 left-[375px] z-50">
      <button id="createBtn" class="bg-lime-500 text-white px-3 py-1 rounded text-xs font-extrabold shadow-md">Create Delivery</button>
    </div>

    <!-- Modal -->
    <div id="manageModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
      <form id="deliveryForm" method="POST" class="bg-[#d7e4ff] rounded-lg p-6 shadow-md w-[360px] relative">
        <button type="button" id="closeModalBtn" class="absolute top-2 right-2 font-bold text-xl text-[#0f2e4d]">&times;</button>
        <h3 id="modalTitle" class="bg-[#a9c5ff] inline-block px-3 py-1 font-extrabold text-sm mb-4">Manage Delivery</h3>
        <div class="grid grid-cols-2 gap-x-4 gap-y-3 text-[13px] font-extrabold text-[#1e2f4a]">
          <input type="hidden" name="delivery_id" id="delivery_id">
          <input type="hidden" name="user_id" id="user_id">
          <input type="hidden" name="order_id" id="order_id">
          <div id="orderSelectContainer" class="flex flex-col col-span-2">
            <label class="flex flex-col">
              Order ID
              <select id="orderSelect" class="rounded border px-2 py-1 text-[13px] font-normal" required>
                <option value="">Select an order</option>
              </select>
            </label>
          </div>
          <label class="flex flex-col">
            Scheduled Time
            <input name="scheduled_time" id="scheduled_time" type="datetime-local" class="rounded border px-2 py-1 text-[13px] font-normal" required>
          </label>
          <label class="flex flex-col">
            Status
            <select name="delivery_status" id="delivery_status" class="rounded border px-2 py-1 text-[13px] font-normal" required>
              <option value="scheduled">Scheduled</option>
              <option value="in_transit">In Transit</option>
              <option value="delivered">Delivered</option>
            </select>
            <span id="statusNote" class="text-xs text-gray-600 mt-1"></span>
          </label>
          <label class="flex flex-col">
            Courier
            <select name="courier_type" id="courier_type" class="rounded border px-2 py-1 text-[13px] font-normal" required>
              <option value="Move It">Move It</option>
              <option value="Maxim">Maxim</option>
              <option value="Motor">Motor</option>
            </select>
          </label>
          <label class="flex flex-col col-span-2">
            Plate Number
            <input name="plate_number" id="plate_number" class="rounded border px-2 py-1 text-[13px] font-normal w-full" required>
          </label>
        </div>
        <div class="mt-4 text-center">
          <button type="submit" class="bg-lime-400 text-white px-3 py-1 rounded text-xs font-extrabold shadow-md">Save</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    let currentPage = 1, limit = 15;
    function loadPage(page = 1) {
      const params = new URLSearchParams({
        page: page,
        limit: limit
      });
      
      if (currentStatus) {
        params.append('status', currentStatus);
      }
      
      if (searchQuery) {
        params.append('search', searchQuery);
      }

      fetch(`../../backend/deliveries/fetch_deliveries.php?${params}`)
        .then(res => res.json())
        .then(data => {
          if (!data.success) return alert(data.error || 'Failed to load deliveries');
          populateTable(data.data, page, data.total);
          currentPage = page;
        });
    }

    function populateTable(data, page, total) {
      const tbody = document.querySelector('tbody');
      tbody.innerHTML = '';
      data.forEach(d => {
        const row = document.createElement('tr');
        row.className = 'border-t border-gray-200';
        // Always use order_info and user_info from the database if available
        const userInfo = d.user_info || (d.user_name ? `#${d.user_id} - ${d.user_name}` : `#${d.user_id}`);
        const orderDetails = d.order_info || d.order_details || `Order #${d.order_id}`;
        row.innerHTML = `
          <td class="px-2 py-1">${d.delivery_id}</td>
          <td class="px-2 py-1">${userInfo}</td>
          <td class="px-2 py-1">${orderDetails}</td>
          <td class="px-2 py-1">${d.scheduled_time}</td>
          <td class="px-2 py-1">${d.delivery_status}</td>
          <td class="px-2 py-1">${d.courier_type}</td>
          <td class="px-2 py-1">${d.plate_number}</td>
          <td class="px-2 py-1 text-right">
            <button class="editBtn text-blue-600 text-xs mr-2" data='${JSON.stringify(d)}'>Edit</button>
            <form
              method = "POST"
              action="../../backend/deliveries/delete_delivery.php"
              class="inline"
              onsubmit="return confirm('Are you sure you want to delete this delivery?')"
            >
            <input type="hidden" name="delivery_id" value="${d.delivery_id}">
            <button type="submit" class="deleteBtn text-red-600 text-xs">
              Delete
            </button>
            </form>
          </td>`;
        tbody.appendChild(row);
      });
      renderPagination(total, page);
      attachEditButtons();
    }

    function renderPagination(total, page) {
      const totalPages = Math.ceil(total / limit);
      const container = document.getElementById('paginationControls');
      container.innerHTML = '';

      if (page > 1) {
        container.appendChild(createNavBtn('Previous', () => loadPage(page - 1)));
      }

      for (let i = 1; i <= totalPages; i++) {
        container.appendChild(createNavBtn(i, () => loadPage(i), i === page));
      }

      if (page < totalPages) {
        container.appendChild(createNavBtn('Next', () => loadPage(page + 1)));
      }
    }

    function createNavBtn(label, onClick, active = false) {
      const btn = document.createElement('button');
      btn.innerText = label;
      btn.className = `px-3 py-1 rounded ${active ? 'bg-blue-700 text-white' : 'bg-blue-100 hover:bg-blue-200'}`;
      btn.onclick = onClick;
      return btn;
    }

    function attachEditButtons() {
      document.querySelectorAll('.editBtn').forEach(btn => {
        btn.onclick = () => {
          const data = JSON.parse(btn.getAttribute('data'));
          openModal('Edit Delivery', '../../backend/deliveries/update_delivery.php', data);
        };
      });
    }

    const modal = document.getElementById('manageModal');
    const form = document.getElementById('deliveryForm');

    function openModal(title, action, data = {}) {
      document.getElementById('modalTitle').innerText = title;
      form.action = action;

      const fields = ['delivery_id', 'order_id', 'user_id', 'scheduled_time', 'delivery_status', 'courier_type', 'plate_number'];
      const isEdit = title.includes('Edit');
      
      // Reset status note
      document.getElementById('statusNote').textContent = '';

      // Handle the order selection differently for create vs edit
      const orderSelectContainer = document.getElementById('orderSelectContainer');
      const orderSelect = document.getElementById('orderSelect');
      const orderIdInput = document.getElementById('order_id');
      
      if (isEdit) {
        // Hide the order select container in edit mode
        orderSelectContainer.style.display = 'none';
        // Set the hidden order_id value
        orderIdInput.value = data.order_id;
      } else {
        // Show the order select container in create mode
        orderSelectContainer.style.display = 'block';
        orderIdInput.value = '';
        loadOrders(); // Reload orders for new delivery
        
        // Add change event listener to update hidden input
        orderSelect.onchange = function() {
          orderIdInput.value = this.value;
        };
      }

      fields.forEach(f => {
        const input = document.getElementById(f);
        if (f === 'delivery_id') {
          input.value = data[f] || '';
          input.readOnly = isEdit;
        } else if (f === 'order_id' && isEdit) {
          // For editing, make sure we keep the order_id
          input.value = data[f] || '';
        } else {
          input.value = data[f] || '';
        }
      });

      modal.classList.remove('hidden');
    }

    document.getElementById('createBtn').onclick = () => openModal('Create Delivery', '../../backend/deliveries/add_delivery.php');
    document.getElementById('closeModalBtn').onclick = () => modal.classList.add('hidden');
    modal.onclick = e => { if (e.target === modal) modal.classList.add('hidden'); };

    // Add these variables at the top of your script
    let currentStatus = '';
    let searchQuery = '';

    function applyStatusFilter(status) {
      currentStatus = status;
      document.querySelectorAll('.status-filter').forEach(btn => {
        if (btn.dataset.status === status) {
          btn.classList.add('bg-blue-500', 'text-white');
        } else {
          btn.classList.remove('bg-blue-500', 'text-white');
        }
      });
      loadPage(1);
    }

    // Add event listeners for search and filter
    document.querySelectorAll('.status-filter').forEach(btn => {
      btn.addEventListener('click', () => {
        const status = btn.dataset.status;
        applyStatusFilter(status === currentStatus ? '' : status);
      });
    });

    document.getElementById('searchBtn').addEventListener('click', () => {
      searchQuery = document.getElementById('searchInput').value.trim();
      loadPage(1);
    });

    document.getElementById('searchInput').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        searchQuery = e.target.value.trim();
        loadPage(1);
      }
    });

    window.addEventListener('DOMContentLoaded', () => {
      loadPage();
      loadOrders();
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

    function loadOrders() {
      fetch('../../backend/orders/get_confirmed_orders.php')
        .then(res => res.json())
        .then(data => {
          if (!data.success) {
            console.error('Failed to load orders:', data.error);
            return;
          }
          const orderSelect = document.getElementById('orderSelect');
          orderSelect.innerHTML = '<option value="">Select an order</option>';
          data.data.forEach(order => {
            const option = document.createElement('option');
            option.value = order.order_id;
            option.textContent = `Order #${order.order_id} - ${order.order_details} (₱${order.total_amount})`;
            orderSelect.appendChild(option);
          });
        })
        .catch(err => console.error('Error loading orders:', err));
    }

    // Function to check and update delivery status based on scheduled time
    function updateDeliveryStatus() {
      const scheduledTimeInput = document.getElementById('scheduled_time');
      const statusSelect = document.getElementById('delivery_status');
      const statusNote = document.getElementById('statusNote');
      
      if (!scheduledTimeInput.value) return;

      const scheduledTime = new Date(scheduledTimeInput.value);
      const now = new Date();
      
      // If delivery is already marked as delivered, don't change it
      if (statusSelect.value === 'delivered') {
        statusNote.textContent = 'Delivery has been completed';
        return;
      }

      // Compare dates (ignoring time for "in_transit" check)
      const isToday = scheduledTime.toDateString() === now.toDateString();
      
      if (isToday) {
        statusSelect.value = 'in_transit';
        statusNote.textContent = 'Automatically set to In Transit (scheduled for today)';
      } else if (scheduledTime > now) {
        statusSelect.value = 'scheduled';
        statusNote.textContent = 'Automatically set to Scheduled (future date)';
      }
    }

    // Add event listener for scheduled time changes
    document.getElementById('scheduled_time').addEventListener('change', updateDeliveryStatus);

    // Handle form submission with status updates
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      try {
        const formData = new FormData(form);
        const status = formData.get('delivery_status');
        const orderId = formData.get('order_id');
        const deliveryId = formData.get('delivery_id');
        
        // First update the delivery
        const deliveryResponse = await fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          }
        });
        
        if (!deliveryResponse.ok) {
          throw new Error('Network response was not ok');
        }
        
        let deliveryResult;
        try {
          deliveryResult = await deliveryResponse.json();
        } catch (error) {
          const text = await deliveryResponse.text();
          console.error('Response text:', text);
          throw new Error('Invalid JSON response from server');
        }
        
        if (!deliveryResult.success) {
          throw new Error(deliveryResult.error || 'Failed to save delivery');
        }
        
        // If delivery was successfully updated and status is "delivered", update order status
        if (status === 'delivered') {
          try {
            const orderResponse = await fetch('../../backend/orders/update_order.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `order_id=${orderId}&status=completed`
            });
            
            if (!orderResponse.ok) {
              console.error('Order status update failed but delivery was updated');
            } else {
              const orderResult = await orderResponse.json();
              if (!orderResult.success) {
                console.error('Order status update returned error but delivery was updated');
              }
            }
          } catch (orderError) {
            console.error('Error updating order status:', orderError);
            // Don't throw here as delivery was already updated
          }
        }
        
        alert('Delivery saved successfully!' + (status === 'delivered' ? ' Order status updated to completed.' : ''));
        modal.classList.add('hidden');
        loadPage(currentPage); // Reload the current page to show updated data
        
      } catch (err) {
        console.error('Error:', err);
        alert(err.message || 'An error occurred while saving');
      }
    });
</script>
</body>
</html>