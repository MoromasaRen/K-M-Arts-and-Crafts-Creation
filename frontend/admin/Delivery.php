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
      <th class="text-left font-extrabold px-2 py-1">Scheduled Time</th>
      <th class="text-left font-extrabold px-2 py-1">Status</th>
      <th class="text-left font-extrabold px-2 py-1">Courier</th>
      <th class="text-left font-extrabold px-2 py-1">Plate #</th>
      <th class="text-left font-extrabold px-2 py-1">Actions</th>
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
      <form id="deliveryForm" method="POST" class="bg-[#d7e4ff] rounded-lg p-6 shadow-md w-[400px] relative">
        <button type="button" id="closeModalBtn" class="absolute top-2 right-2 font-bold text-xl text-[#0f2e4d]">&times;</button>
        <h3 id="modalTitle" class="bg-[#a9c5ff] inline-block px-3 py-1 font-extrabold text-sm mb-4">Manage Delivery</h3>
        <div class="grid grid-cols-2 gap-x-4 gap-y-3 text-[13px] font-extrabold text-[#1e2f4a]">
          <!-- Hidden fields -->
          <input type="hidden" name="delivery_id" id="delivery_id">
          <input type="hidden" name="user_id" id="user_id">
          
          <!-- Order Selection (visible in create mode, hidden in edit mode) -->
          <div id="orderSelectContainer" class="flex flex-col col-span-2">
            <label>
              Order ID
              <select name="order_id" id="order_id" class="rounded border px-2 py-1 text-[13px] font-normal">
                <option value="">Select an order</option>
              </select>
            </label>
          </div>
          
          <!-- Order Info Display (visible in edit mode only) -->
          <div id="orderInfoDisplay" class="flex flex-col col-span-2" style="display: none;">
            <label class="text-gray-600">
              Order Information
              <div id="orderInfoText" class="bg-gray-100 px-2 py-1 rounded text-[13px] font-normal border"></div>
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
          <button type="submit" id="saveBtn" class="bg-lime-400 hover:bg-lime-500 text-white px-4 py-2 rounded text-sm font-extrabold shadow-md transition-colors">Save</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    let currentPage = 1, limit = 15;
    let currentStatus = '';
    let searchQuery = '';

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

      console.log('Fetching deliveries...');
      fetch(`../../backend/deliveries/fetch_deliveries.php?${params}`)
        .then(res => res.json())
        .then(data => {
          console.log('Deliveries response:', data);
          if (!data.success) return alert(data.error || 'Failed to load deliveries');
          populateTable(data.data, page, data.total);
          currentPage = page;
        })
        .catch(err => {
          console.error('Error loading deliveries:', err);
          alert('Error loading deliveries. Please check the console.');
        });
    }

    function populateTable(data, page, total) {
      const tbody = document.querySelector('tbody');
      tbody.innerHTML = '';
      data.forEach(d => {
        const row = document.createElement('tr');
        row.className = 'border-t border-gray-200';
        
        // Safely handle user info and order details
        const userInfo = d.user_info || (d.user_name ? `#${d.user_id} - ${d.user_name}` : `User #${d.user_id}`);
        const orderDetails = d.order_info || d.order_details || `Order #${d.order_id}`;
        
        row.innerHTML = `
          <td class="px-2 py-1">${d.delivery_id}</td>
          <td class="px-2 py-1">${userInfo}</td>
          <td class="px-2 py-1">${orderDetails}</td>
          <td class="px-2 py-1">${formatDateTime(d.scheduled_time)}</td>
          <td class="px-2 py-1">
            <span class="px-2 py-1 rounded text-xs ${getStatusColor(d.delivery_status)}">
              ${d.delivery_status}
            </span>
          </td>
          <td class="px-2 py-1">${d.courier_type}</td>
          <td class="px-2 py-1">${d.plate_number}</td>
          <td class="px-2 py-1 text-right">
            <button class="editBtn text-blue-600 text-xs mr-2 hover:underline" data-delivery='${JSON.stringify(d)}'>Edit</button>
            <form method="POST" action="../../backend/deliveries/delete_delivery.php" class="inline" onsubmit="return confirm('Are you sure you want to delete this delivery?')">
              <input type="hidden" name="delivery_id" value="${d.delivery_id}">
              <button type="submit" class="deleteBtn text-red-600 text-xs hover:underline">Delete</button>
            </form>
          </td>`;
        tbody.appendChild(row);
      });
      renderPagination(total, page);
      attachEditButtons();
    }

    function formatDateTime(dateTimeStr) {
      if (!dateTimeStr) return 'N/A';
      try {
        const date = new Date(dateTimeStr);
        return date.toLocaleString();
      } catch (e) {
        return dateTimeStr;
      }
    }

    function getStatusColor(status) {
      switch (status) {
        case 'scheduled': return 'bg-yellow-100 text-yellow-800';
        case 'in_transit': return 'bg-blue-100 text-blue-800';
        case 'delivered': return 'bg-green-100 text-green-800';
        default: return 'bg-gray-100 text-gray-800';
      }
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
          try {
            const data = JSON.parse(btn.getAttribute('data-delivery'));
            console.log('Edit data:', data);
            openModal('Edit Delivery', '../../backend/deliveries/update_delivery.php', data);
          } catch (err) {
            console.error('Error parsing delivery data:', err);
            alert('Error loading delivery data. Please try again.');
          }
        };
      });
    }

    const modal = document.getElementById('manageModal');
    const form = document.getElementById('deliveryForm');

    function openModal(title, action, data = {}) {
      console.log('Opening modal:', title, data);
      
      document.getElementById('modalTitle').innerText = title;
      form.action = action;
      
      const isEdit = title.includes('Edit');
      
      // Reset form
      form.reset();
      document.getElementById('statusNote').textContent = '';
      
      // Show/hide appropriate containers
      const orderSelectContainer = document.getElementById('orderSelectContainer');
      const orderInfoDisplay = document.getElementById('orderInfoDisplay');
      
      if (isEdit) {
        // Edit mode - hide order select, show order info
        orderSelectContainer.style.display = 'none';
        orderInfoDisplay.style.display = 'block';
        
        // Populate all fields with existing data
        document.getElementById('delivery_id').value = data.delivery_id || '';
        document.getElementById('user_id').value = data.user_id || '';
        
        // Set order info display
        const userInfo = data.user_info || (data.user_name ? `#${data.user_id} - ${data.user_name}` : `User #${data.user_id}`);
        const orderDetails = data.order_info || data.order_details || `Order #${data.order_id}`;
        document.getElementById('orderInfoText').textContent = `${orderDetails} - ${userInfo}`;
        
        // Create a hidden input for order_id in edit mode
        let orderIdInput = document.getElementById('order_id_hidden');
        if (!orderIdInput) {
          orderIdInput = document.createElement('input');
          orderIdInput.type = 'hidden';
          orderIdInput.name = 'order_id';
          orderIdInput.id = 'order_id_hidden';
          form.appendChild(orderIdInput);
        }
        orderIdInput.value = data.order_id || '';
        
        // Format scheduled time for datetime-local input
        if (data.scheduled_time) {
          const date = new Date(data.scheduled_time);
          const localDateTime = new Date(date.getTime() - date.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
          document.getElementById('scheduled_time').value = localDateTime;
        }
        
        document.getElementById('delivery_status').value = data.delivery_status || 'scheduled';
        document.getElementById('courier_type').value = data.courier_type || 'Motor';
        document.getElementById('plate_number').value = data.plate_number || '';
        
      } else {
        // Create mode - show order select, hide order info
        orderSelectContainer.style.display = 'block';
        orderInfoDisplay.style.display = 'none';
        
        // Remove hidden order_id input if it exists
        const existingHidden = document.getElementById('order_id_hidden');
        if (existingHidden) {
          existingHidden.remove();
        }
        
        // Load orders for selection
        loadOrders();
        
        // Set default datetime to current time
        const now = new Date();
        const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        document.getElementById('scheduled_time').value = localDateTime;
        
        // Set defaults
        document.getElementById('delivery_status').value = 'scheduled';
        document.getElementById('courier_type').value = 'Motor';
      }

      modal.classList.remove('hidden');
    }

    // Event listeners
    document.getElementById('createBtn').onclick = () => openModal('Create Delivery', '../../backend/deliveries/add_delivery.php');
    document.getElementById('closeModalBtn').onclick = () => modal.classList.add('hidden');
    modal.onclick = e => { if (e.target === modal) modal.classList.add('hidden'); };

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

    // Load admin info
    window.addEventListener("DOMContentLoaded", function () {
      console.log('Page loaded, initializing...');
      loadPage();
      
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
      console.log('Loading orders...');
      fetch('../../backend/orders/get_confirmed_orders.php')
        .then(res => res.json())
        .then(data => {
          console.log('Orders loaded:', data);
          if (!data.success) {
            console.error('Failed to load orders:', data.error);
            return;
          }
          const orderSelect = document.getElementById('order_id');
          orderSelect.innerHTML = '<option value="">Select an order</option>';
          data.data.forEach(order => {
            const option = document.createElement('option');
            option.value = order.order_id;
            option.textContent = `Order #${order.order_id} - ${order.order_details} (₱${order.total_amount})`;
            option.dataset.userId = order.user_id; // Store user_id for later use
            orderSelect.appendChild(option);
          });
          
          // Add change event listener to set user_id when order is selected
          orderSelect.onchange = function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption && selectedOption.dataset.userId) {
              document.getElementById('user_id').value = selectedOption.dataset.userId;
            }
          };
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

    // Handle form submission
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      // Disable the submit button to prevent double submission
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = 'Saving...';
      
      try {
        const formData = new FormData(form);
        const status = formData.get('delivery_status');
        const deliveryId = formData.get('delivery_id');
        const isEdit = !!deliveryId;
        
        console.log('Form submission data:', Object.fromEntries(formData));
        
        // Get order_id from the right source
        let orderId;
        if (isEdit) {
          // In edit mode, get from hidden input
          const hiddenOrderInput = document.getElementById('order_id_hidden');
          orderId = hiddenOrderInput ? hiddenOrderInput.value : formData.get('order_id');
          
          // Ensure order_id is in the FormData for backend
          if (orderId) {
            formData.set('order_id', orderId);
          }
        } else {
          orderId = formData.get('order_id');
        }
        
        console.log('Order ID:', orderId, 'Is Edit:', isEdit);
        
        if (!orderId) {
          throw new Error('Order ID is required');
        }
        
        // Validate required fields - but skip order_id validation for edit mode since it's hidden
        if (!formData.get('scheduled_time')) throw new Error('Scheduled time is required');
        if (!formData.get('delivery_status')) throw new Error('Status is required');
        if (!formData.get('courier_type')) throw new Error('Courier is required');
        if (!formData.get('plate_number')) throw new Error('Plate number is required');
        
        console.log('Submitting delivery update/create to:', form.action);
        console.log('Final FormData:', Object.fromEntries(formData));
        
        // Submit delivery form
        const deliveryResponse = await fetch(form.action, {
          method: 'POST',
          body: formData
        });
        
        let deliveryResult;
        try {
          const responseText = await deliveryResponse.text();
          console.log('Raw response:', responseText);
          
          // Try to parse as JSON
          if (responseText.trim().startsWith('{') || responseText.trim().startsWith('[')) {
            deliveryResult = JSON.parse(responseText);
          } else {
            // If not JSON, treat as error
            throw new Error('Server returned non-JSON response: ' + responseText.substring(0, 100));
          }
        } catch (parseError) {
          console.error('JSON parse error:', parseError);
          throw new Error('Invalid response from server. Check backend logs.');
        }
        
        if (!deliveryResult.success) {
          throw new Error(deliveryResult.error || deliveryResult.message || 'Failed to save delivery');
        }
        
        // If delivery status is "delivered", update order status to "completed"
        if (status === 'delivered') {
          try {
            console.log('Updating order status to completed for order:', orderId);
            const orderResponse = await fetch('../../backend/orders/update_order.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `order_id=${orderId}&status=completed`
            });
            
            const orderResult = await orderResponse.json();
            if (!orderResult.success) {
              console.warn('Order status update failed:', orderResult.error);
            } else {
              console.log('Order status updated successfully');
            }
          } catch (orderError) {
            console.warn('Error updating order status:', orderError);
          }
        }
        
        alert(`Delivery ${isEdit ? 'updated' : 'created'} successfully!` + (status === 'delivered' ? ' Order status updated to completed.' : ''));
        modal.classList.add('hidden');
        loadPage(currentPage);
        
      } catch (err) {
        console.error('Form submission error:', err);
        alert(err.message || 'An error occurred while saving');
      } finally {
        // Re-enable the submit button
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    });

    // Add click event listener to submit button as backup
    document.addEventListener('DOMContentLoaded', function() {
      const submitBtn = document.querySelector('#saveBtn');
      if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
          console.log('Submit button clicked');
          // Check if form is valid
          const form = document.getElementById('deliveryForm');
          console.log('Form validity:', form.checkValidity());
        });
      }
    });

    // Debug function to check form state
    function debugFormState() {
      const form = document.getElementById('deliveryForm');
      const formData = new FormData(form);
      console.log('Current form data:', Object.fromEntries(formData));
      console.log('Form valid:', form.checkValidity());
      
      // Check each required field
      const requiredFields = form.querySelectorAll('[required]');
      requiredFields.forEach(field => {
        console.log(`Field ${field.name}: value="${field.value}", valid=${field.validity.valid}`);
      });
    }

    // Add this function to window for debugging
    window.debugFormState = debugFormState;
</script>
</body>
</html>