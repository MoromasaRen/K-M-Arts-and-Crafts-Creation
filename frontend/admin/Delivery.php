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
    <div class="flex items-center mb-4 text-[#0f2e4d]">
      <button class="text-2xl mr-3">
        <i class="fas fa-bars"></i>
      </button>
      <h2 class="font-extrabold text-lg border-b border-[#0f2e4d] pb-1">Deliveries</h2>
    </div>

    <!-- Table -->
<table class="w-full bg-white rounded-md shadow-md text-sm text-[#0f2e4d] border-separate border-spacing-1 mt-6">
  <thead>
    <tr>
      <th class="text-left font-extrabold px-2 py-1 rounded-tl-md">Delivery ID</th>
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
          <label class="flex flex-col">
            Delivery ID
            <input name="delivery_id" id="delivery_id" class="rounded border px-2 py-1 text-[13px] font-normal bg-gray-100" readonly>
          </label>
          <label class="flex flex-col">
            Order ID
            <input name="order_id" id="order_id" class="rounded border px-2 py-1 text-[13px] font-normal bg-gray-100" readonly>
          </label>
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
      fetch(`../../backend/deliveries/fetch_deliveries.php?page=${page}&limit=${limit}`)
        .then(res => res.json())
        .then(data => {
          if (!data.success) return alert(data.error || 'Failed to load deliveries');
          populateTable(data.data, page, data.total);
        });
    }

    function populateTable(data, page, total) {
      const tbody = document.querySelector('tbody');
      tbody.innerHTML = '';
      data.forEach(d => {
        const row = document.createElement('tr');
row.className = 'border-t border-gray-200';
row.innerHTML = `
  <td class="px-2 py-1">${d.delivery_id}</td>
  <td class="px-2 py-1">${d.order_details || d.order_id}</td>
  <td class="px-2 py-1">${d.scheduled_time}</td>
  <td class="px-2 py-1">${d.delivery_status}</td>
  <td class="px-2 py-1">${d.courier_type}</td>
  <td class="px-2 py-1">${d.plate_number}</td>
  <td class="px-2 py-1 text-right">
    <button class="editBtn text-blue-600 text-xs mr-2" data='${JSON.stringify(d)}'>Edit</button>
    <button
      class="deleteBtn text-red-600 text-xs"
      data-id="${d.delivery_id}"
      onclick="handleDelete(this)"
    >
      Delete
    </button>
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

      const fields = ['delivery_id', 'order_id', 'scheduled_time', 'delivery_status', 'courier_type', 'plate_number'];
      fields.forEach(f => {
        const input = document.getElementById(f);
        input.value = data[f] || '';
        input.readOnly = (f === 'delivery_id' && title.includes('Edit'));
      });

      modal.classList.remove('hidden');
    }

    document.getElementById('createBtn').onclick = () => openModal('Create Delivery', '../../backend/deliveries/add_delivery.php');
    document.getElementById('closeModalBtn').onclick = () => modal.classList.add('hidden');
    modal.onclick = e => { if (e.target === modal) modal.classList.add('hidden'); };

    window.addEventListener('DOMContentLoaded', () => loadPage());


   function handleDelete(button) {
  const id = button.getAttribute('data-id');

  if (confirm("Are you sure you want to delete this delivery?")) {
    fetch(`../../backend/deliveries/delete_delivery.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `delivery_id=${encodeURIComponent(id)}`  // Changed from 'id' to 'delivery_id'
    })
    .then(res => res.text())
    .then(text => {
      let data;
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error('Server response:', text);
        throw new Error('Server response was not valid JSON');
      }
      if (data.success) {
        alert("Delivery deleted successfully.");
        loadPage(currentPage);
      } else {
        throw new Error(data.error || "Failed to delete delivery.");
      }
    })
    .catch(err => {
      console.error('Delete error:', err);
      alert(err.message || "An error occurred while deleting.");
    });
  }
}

</script>
</body>
</html>
