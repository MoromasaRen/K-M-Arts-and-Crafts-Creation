<?php require_once '../../backend/session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Profile Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>
<body class="bg-white text-[#1a2e4a] m-0 p-0">
  <script> 
   if (!localStorage.getItem("isLoggedIn")) {
    window.location.href = "/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html";
  }

      const user_Id = localStorage.getItem("user_id");

    fetch(`/K-M-Arts-and-Crafts-Creation/backend/users/get_user_info.php?user_id=${user_Id}`)
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById("first-name").textContent = data.first_name;
          // other fields here
        } else {
          alert("User not found.");
        }
      })

  </script>
  <header class="flex items-center justify-between p-4 sm:p-8 bg-white w-full">
    <!-- Logo (Aligned left) -->
    <div class="flex items-center">
      <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
    </div>

    <!-- Navigation in the center -->
    <nav class="flex gap-8 text-[17px] font-semibold justify-center flex-wrap flex-grow">
      <a href="/K-M-Arts-and-Crafts-Creation/index.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Home</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Shop.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Shop</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Contacts.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Contact</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/About.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">About Us</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
    </nav>

    <!-- Login button on the right -->
    <div id="auth-button" class="ml-auto flex-shrink-0"></div>
  </header>

  <!-- Responsive divider under header -->
  <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3;"></div>

  <!-- Main Content -->
  <main class="flex-1 p-6 text-[#1a1a1a]">

    <section class="max-w-6xl mx-auto">
              <!-- <h2
                class="font-bold text-base tracking-widest mb-2 border-b border-[#1a1a1a] pb-1"
              >
                My Profile
              </h2> -->

              <div class="space-y-4">
                <!-- User Summary Card -->
                <div class="bg-white rounded-xl p-4 shadow-md flex items-center justify-between">
                  <img
                    src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
                    alt="User"
                    class="w-16 h-16 rounded-full"
                  />
                  <div class="ml-5">
                    <p id="summary-username" class="font-bold text-lg tracking-wide">
                    </p>
                    <p class="text-xs font-normal">User</p>
                    <p id="summary-address" class="text-xs font-normal">
                      Set Address
                    </p>
                  </div>

                  <div class="sm:ml-auto">
                    <button
                      id="logout-btn"
                      class="bg-[#f44336] hover:bg-[#d32f2f] text-white font-semibold text-xs px-4 py-2 rounded-md shadow"
                      title="Logout"
                    >
                      Logout
                    </button>
                  </div>
                </div>

                <!-- Personal Info Section -->
                <div id="personal-info" class="bg-white  rounded-xl p-4 shadow-md grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
                  <div class="col-span-full flex justify-between items-center mb-2">
                    <p class="font-bold text-sm tracking-widest border-b border-[#0f2e4d] pb-1">
                      Personal Information
                    </p>
                    <div id="personal-info-buttons">
                      <button
                        id="edit-personal-info"
                        class="bg-[#f4c7c7] text-[#a94442] text-xs font-semibold px-3 py-1 rounded-md"
                      >
                        Edit
                      </button>
                      <button
                        id="save-personal-info"
                        class="hidden bg-[#4caf50] text-white text-xs font-semibold px-3 py-1 rounded-md mr-2"
                      >
                        Save
                      </button>
                      <button
                        id="cancel-personal-info"
                        class="hidden bg-[#f44336] text-white text-xs font-semibold px-3 py-1 rounded-md"
                      >
                        Cancel
                      </button>
                    </div>
                  </div>
                  <div>
                    <p class="text-xs font-semibold tracking-widest">First Name</p>
                    <p id="first-name-text" class="font-bold text-sm"></p>
                    <input
                      id="first-name-input"
                      type="text"
                      class="hidden font-bold text-sm rounded-md p-1 w-full"
                      value="Von"
                    />
                  </div>
                  <div>
                    <p class="text-xs font-semibold tracking-widest">Last Name</p>
                    <p id="last-name-text" class="font-bold text-sm"></p>
                    <input
                      id="last-name-input"
                      type="text"
                      class="hidden font-bold text-sm rounded-md p-1 w-full"
                      value="Malingin"
                    />
                  </div>
                  <div>
                    <p class="text-xs font-semibold tracking-widest">Date Of Birth</p>
                    <p id="dob-text" class="font-bold text-sm">01 - 24 -2000</p>
                    <input
                      id="dob-input"
                      type="date"
                      class="hidden font-bold text-sm rounded-md p-1 w-full"
                      value="2000-01-24"
                    />
                  </div>
                  <div>
                    <p class="text-xs font-semibold tracking-widest">Phone</p>
                    <p id="phone-text" class="font-bold text-sm">099</p>
                    <input
                      id="phone-input"
                      type="text"
                      class="hidden font-bold text-sm rounded-md p-1 w-full"
                      value="099"
                    />
                  </div>
                  <div>
                    <p class="text-xs font-semibold tracking-widest">Email Address</p>
                    <p id="email-text" class="font-bold text-sm underline">
                      sample@gmail.com
                    </p>
                    <input
                      id="email-input"
                      type="email"
                      class="hidden font-bold text-sm rounded-md p-1 w-full"
                      value="sample@gmail.com"
                    />
                  </div>
                </div>

                <!-- Address Section -->
        <!-- Address Section -->
        <div id="address-info" class="bg-white rounded-xl p-4 shadow-md grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
        <!-- Header Row: Title + Buttons -->
        <div class="col-span-full flex justify-between items-center mb-2">
          <p class="font-bold text-sm tracking-widest border-b border-[#0f2e4d] pb-1">
            Address
          </p>
          <div id="address-info-buttons">
            <button
              id="edit-address-info"
              class="bg-[#f4c7c7] text-[#a94442] text-xs font-semibold px-3 py-1 rounded-md"
            >
              Edit
            </button>
            <button
              id="save-address-info"
              class="hidden bg-[#4caf50] text-white text-xs font-semibold px-3 py-1 rounded-md mr-2"
            >
              Save
            </button>
            <button
              id="cancel-address-info"
              class="hidden bg-[#f44336] text-white text-xs font-semibold px-3 py-1 rounded-md"
            >
              Cancel
            </button>
          </div>
        </div>

        <!-- Fields -->
         <div>
          <p class="text-xs font-semibold tracking-widest">Address</p>
          <p id="address-text" class="font-bold text-sm"></p> <!-- Add this line -->
          <input
            id="address-input"
            type="text"
            class="hidden font-bold text-sm rounded-md p-1 w-full"
            value="123 Sample Street"
          />
        </div>
        <div>
          <p class="text-xs font-semibold tracking-widest">Country</p>
          <p id="country-text" class="font-bold text-sm"></p>
          <input
            id="country-input"
            type="text"
            class="hidden font-bold text-sm rounded-md p-1 w-full"
            value="Philippines"
          />
        </div>
        <div>
          <p class="text-xs font-semibold tracking-widest">City</p>
          <p id="city-text" class="font-bold text-sm"></p>
          <input
            id="city-input"
            type="text"
            class="hidden font-bold text-sm rounded-md p-1 w-full"
            value="Cebu"
          />
        </div>
        <div>
          <p class="text-xs font-semibold tracking-widest">Postal Code</p>
          <p id="postal-code-text" class="font-bold text-sm"></p>
          <input
            id="postal-code-input"
            type="text"
            class="hidden font-bold text-sm rounded-md p-1 w-full"
            value="6000"
          />
        </div>
        </div>

            </section>

    <!-- My Orders Section -->
    <section class="max-w-6xl mx-auto mt-12 mb-12">
      <h2 class="text-2xl font-semibold text-left mb-4">My Orders</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Orders to Pay Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="font-semibold mb-2">Orders to Pay</h3>
          <ul id="orders-to-pay-list" class="list-none space-y-7">
            <li>Loading...</li>
          </ul>
        </div>
        
        <!-- Confirmed Orders Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="font-semibold mb-2">Confirmed Orders</h3>
          <ul id="confirmed-orders-list" class="list-none space-y-7">
            <li>Loading...</li>
          </ul>
        </div>
        
        <!-- Previous Orders Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="font-semibold mb-2">Previous Orders</h3>
            <ul id="previous-orders-list" class="list-none space-y-7">
              <li>Loading...</li>
            </ul>
        </div>
      </div>
    </section>


  </main>

  <footer class="bg-[#183655] text-white py-8 mt-16">
    <div class="max-w-screen-xl mx-auto px-6 flex flex-col items-center justify-center text-center space-y-6">
      <!-- Larger Logo -->
      <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo3.png" alt="KM Arts & Crafts Creation Logo" class="w-80 h-auto" />

      <!-- Larger Social Media Icons -->
      <div class="flex gap-6">
        <a href="#" aria-label="Instagram">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/InstaIconWhite.png" alt="Instagram" class="w-11 h-11" />
        </a>
        <a href="#" aria-label="Facebook">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/FacebookIconWhite.png" alt="Facebook" class="w-11 h-11" />
        </a>
        <a href="#" aria-label="TikTok">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/TikTokIconWhite.png" alt="TikTok" class="w-11 h-11" />
        </a>
      </div>

      <!-- Copyright -->
      <p class="text-sm tracking-widest">
        2025 KM ARTS & CRAFTS. All rights reserved.
      </p>
    </div>
  </footer>
<script>

  
  let originalPersonalData = {};
  let originalAddressData = {};

  const userId = localStorage.getItem("user_id");

  function toggleEdit(sectionId, enable) {
    const section = document.getElementById(sectionId);
    const textFields = section.querySelectorAll('[id$="-text"]');
    const inputFields = section.querySelectorAll('[id$="-input"]');
    const editBtn = document.getElementById(`edit-${sectionId}`);
    const saveBtn = document.getElementById(`save-${sectionId}`);
    const cancelBtn = document.getElementById(`cancel-${sectionId}`);

    if (enable) {
      if (sectionId === 'personal-info') {
        originalPersonalData = {
          firstName: document.getElementById('first-name-text').textContent,
          lastName: document.getElementById('last-name-text').textContent,
          email: document.getElementById('email-text').textContent,
          phone: document.getElementById('phone-text').textContent,
          dob: document.getElementById('dob-text').textContent
        };
      } else if (sectionId === 'address-info') {
        originalAddressData = {
          address: document.getElementById('address-text').textContent,
          country: document.getElementById('country-text').textContent,
          city: document.getElementById('city-text').textContent,
          postalCode: document.getElementById('postal-code-text').textContent
        };
      }

      section.classList.add("editing");
      textFields.forEach((el) => el.classList.add("hidden"));
      inputFields.forEach((el) => el.classList.remove("hidden"));
      editBtn.classList.add("hidden");
      saveBtn.classList.remove("hidden");
      cancelBtn.classList.remove("hidden");
    } else {
      section.classList.remove("editing");
      textFields.forEach((el) => el.classList.remove("hidden"));
      inputFields.forEach((el) => el.classList.add("hidden"));
      editBtn.classList.remove("hidden");
      saveBtn.classList.add("hidden");
      cancelBtn.classList.add("hidden");
    }
  }

  function cancelChanges(sectionId) {
    if (sectionId === 'personal-info') {
      document.getElementById('first-name-text').textContent = originalPersonalData.firstName;
      document.getElementById('last-name-text').textContent = originalPersonalData.lastName;
      document.getElementById('email-text').textContent = originalPersonalData.email;
      document.getElementById('phone-text').textContent = originalPersonalData.phone;
      document.getElementById('dob-text').textContent = originalPersonalData.dob;

      document.getElementById('first-name-input').value = originalPersonalData.firstName;
      document.getElementById('last-name-input').value = originalPersonalData.lastName;
      document.getElementById('email-input').value = originalPersonalData.email;
      document.getElementById('phone-input').value = originalPersonalData.phone;

      const dobParts = originalPersonalData.dob.split(' - ');
      if (dobParts.length === 3) {
        const formattedDate = `${dobParts[2]}-${dobParts[0].padStart(2, '0')}-${dobParts[1].padStart(2, '0')}`;
        document.getElementById('dob-input').value = formattedDate;
      }
    } else if (sectionId === 'address-info') {
      document.getElementById('address-text').textContent = originalAddressData.address;
      document.getElementById('country-text').textContent = originalAddressData.country;
      document.getElementById('city-text').textContent = originalAddressData.city;
      document.getElementById('postal-code-text').textContent = originalAddressData.postalCode;

      document.getElementById('address-input').value = originalAddressData.address;
      document.getElementById('country-input').value = originalAddressData.country;
      document.getElementById('city-input').value = originalAddressData.city;
      document.getElementById('postal-code-input').value = originalAddressData.postalCode;
    }

    toggleEdit(sectionId, false);
  }

  function saveChanges(sectionId) {
    if (sectionId === 'personal-info') {
      const firstName = document.getElementById('first-name-input').value;
      const lastName = document.getElementById('last-name-input').value;
      const email = document.getElementById('email-input').value;
      const phone = document.getElementById('phone-input').value;
      const dobInput = document.getElementById('dob-input').value;

      let dobDisplay = dobInput;
      if (dobInput) {
        const date = new Date(dobInput);
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const year = date.getFullYear();
        dobDisplay = `${month} - ${day} - ${year}`;
      }

      document.getElementById('first-name-text').textContent = firstName;
      document.getElementById('last-name-text').textContent = lastName;
      document.getElementById('email-text').textContent = email;
      document.getElementById('phone-text').textContent = phone;
      document.getElementById('dob-text').textContent = dobDisplay;

      const sidebarFirst = document.getElementById('sidebar-first-name');
      const sidebarLast = document.getElementById('sidebar-last-name');
      const summaryUser = document.getElementById('summary-username');

      if (sidebarFirst) sidebarFirst.textContent = firstName;
      if (sidebarLast) sidebarLast.textContent = lastName;
      if (summaryUser) summaryUser.textContent = `${firstName} ${lastName}`;

      sendUserDataToBackend();
    } else if (sectionId === 'address-info') {
      const address = document.getElementById('address-input').value;
      const country = document.getElementById('country-input').value;
      const city = document.getElementById('city-input').value;
      const postalCode = document.getElementById('postal-code-input').value;

      document.getElementById('address-text').textContent = address || 'Not provided';
      document.getElementById('country-text').textContent = country || 'Not provided';
      document.getElementById('city-text').textContent = city || 'Not provided';
      document.getElementById('postal-code-text').textContent = postalCode || 'Not provided';

      const summaryAddr = document.getElementById('summary-address');
      if (summaryAddr) summaryAddr.textContent = `${country}, ${city} ${postalCode}`;

      sendAddressDataToBackend();
    }

    toggleEdit(sectionId, false);
  }

  function sendUserDataToBackend() {
    if (!userId) return alert("User ID not found. Please log in again.");

    const data = {
      update_type: "personal_info",
      user_id: userId,
      first_name: document.getElementById("first-name-input").value,
      last_name: document.getElementById("last-name-input").value,
      email: document.getElementById("email-input").value,
      contact_number: document.getElementById("phone-input").value,
      dateofbirth: document.getElementById("dob-input").value,
    };

    fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/update_user_info.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
      if (!response.success) alert("Update failed: " + response.message);
    })
    .catch(err => alert("Something went wrong while updating personal info."));
  }

  function sendAddressDataToBackend() {
    if (!userId) return alert("User ID not found. Please log in again.");

    const data = {
      update_type: "address_info",
      user_id: userId,
      address: document.getElementById("address-input").value,
      country: document.getElementById("country-input").value,
      city: document.getElementById("city-input").value,
      postal_code: document.getElementById("postal-code-input").value,
    };

    fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/update_user_info.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
      if (!response.success) alert("Address update failed: " + response.message);
    })
    .catch(err => alert("Something went wrong while updating address info."));
  }

  // NEW FUNCTION: Cancel Order
  function cancelOrder(orderId) {
    // Show confirmation dialog
    if (!confirm("Are you sure you want to cancel this order? This action cannot be undone.")) {
      return;
    }

    // Create form data to match admin delete structure
    const formData = new FormData();
    formData.append('order_id', orderId);

    // Send cancellation request to backend
    fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/orders/cancel_order.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(response => {
      if (response.success) {
        alert("Order cancelled successfully!");
        // Reload the orders to reflect the change
        const userId = localStorage.getItem("user_id");
        loadAllOrders(userId);
      } else {
        alert("Failed to cancel order: " + (response.error || "Unknown error"));
      }
    })
    .catch(err => {
      console.error("Error cancelling order:", err);
      alert("Something went wrong while cancelling the order. Please try again.");
    });
  }

  // Events
  document.getElementById("edit-personal-info").addEventListener("click", () => toggleEdit("personal-info", true));
  document.getElementById("save-personal-info").addEventListener("click", () => saveChanges("personal-info"));
  document.getElementById("cancel-personal-info").addEventListener("click", () => cancelChanges("personal-info"));

  document.getElementById("edit-address-info").addEventListener("click", () => toggleEdit("address-info", true));
  document.getElementById("save-address-info").addEventListener("click", () => saveChanges("address-info"));
  document.getElementById("cancel-address-info").addEventListener("click", () => cancelChanges("address-info"));

  // Logout
  document.getElementById("logout-btn").addEventListener("click", function (e) {
    e.preventDefault();
    fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/auth/logout.php", {
      method: "POST",
      credentials: "include"
    })
    .then(() => {
      localStorage.clear();
      window.location.href = "/K-M-Arts-and-Crafts-Creation/index.php";
    })
    .catch(() => alert("Something went wrong during logout."));
  });

  // Load user data
  window.addEventListener("DOMContentLoaded", function () {
    if (!userId) {
      alert("Please log in to view your profile.");
      return (window.location.href = "/K-M-Arts-and-Crafts-Creation/index.php");
    }

    fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/get_user_info.php?user_id=${userId}`)
      .then(res => res.json())
      .then(data => {
        if (!data.success) return alert("Failed to load user data: " + data.message);

        const dobDisplay = data.dateofbirth
          ? (() => {
              const d = new Date(data.dateofbirth);
              return `${(d.getMonth() + 1).toString().padStart(2, '0')} - ${d.getDate().toString().padStart(2, '0')} - ${d.getFullYear()}`;
            })()
          : '';

        document.getElementById("first-name-text").textContent = data.first_name || '';
        document.getElementById("last-name-text").textContent = data.last_name || '';
        document.getElementById("summary-username").textContent = `${data.first_name} ${data.last_name}`;
        document.getElementById("email-text").textContent = data.email || '';
        document.getElementById("dob-text").textContent = dobDisplay || '';
        document.getElementById("phone-text").textContent = data.contact_number || '';
        document.getElementById("address-text").textContent = data.address || '';
        document.getElementById("country-text").textContent = data.country || '';
        document.getElementById("city-text").textContent = data.city || '';
        document.getElementById("postal-code-text").textContent = data.postal_code || '';

        document.getElementById("first-name-input").value = data.first_name || '';
        document.getElementById("last-name-input").value = data.last_name || '';
        document.getElementById("email-input").value = data.email || '';
        document.getElementById("dob-input").value = data.dateofbirth || '';
        document.getElementById("phone-input").value = data.contact_number || '';
        document.getElementById("address-input").value = data.address || '';
        document.getElementById("country-input").value = data.country || '';
        document.getElementById("city-input").value = data.city || '';
        document.getElementById("postal-code-input").value = data.postal_code || '';

        document.getElementById("sidebar-first-name").textContent = data.first_name || '';
        document.getElementById("sidebar-last-name").textContent = data.last_name || '';
        document.getElementById("summary-username").textContent = `${data.first_name || ''} ${data.last_name || ''}`;
        document.getElementById("summary-address").textContent = `${data.country || ''}, ${data.city || ''} ${data.postal_code || ''}`;
      });
      
  loadAllOrders(userId);
  });

  // UPDATED FUNCTION: Load All Orders with Cancel Button
  function loadAllOrders(userId) {
    fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/orders/get_user_orders.php?user_id=${userId}`)
      .then(response => response.json())
      .then(data => {
        const previousOrdersList = document.getElementById("previous-orders-list");
        const ordersToPayList = document.getElementById("orders-to-pay-list");
        const confirmedOrdersList = document.getElementById("confirmed-orders-list");

        // Clear existing content
        previousOrdersList.innerHTML = "";
        ordersToPayList.innerHTML = "";
        confirmedOrdersList.innerHTML = "";

        if (!data.success || data.orders.length === 0) {
          previousOrdersList.innerHTML = "<li class='text-gray-500 text-sm'>No completed orders yet.</li>";
          ordersToPayList.innerHTML = "<li class='text-gray-500 text-sm'>No pending orders yet.</li>";
          confirmedOrdersList.innerHTML = "<li class='text-gray-500 text-sm'>No confirmed orders yet.</li>";
          return;
        }

        data.orders.forEach(order => {
          const li = document.createElement("li");
          
          // Create a list of items
          const items = order.order_details.split(",").map(item => {
            const [name, qty] = item.trim().split(" x");
            return `<div><span class="font-semibold">${name.trim()}</span><br><span class="text-gray-600">Quantity: ${qty || 1}</span></div>`;
          }).join("<br>");

          // Sort based on order_status
          if (order.order_status === "completed") {
            li.className = "border border-gray-300 p-4 rounded-lg bg-gray-50 shadow-sm text-sm text-gray-800 font-medium";
            li.innerHTML = `
              <div class="space-y-2">
                ${items}
                <div class="text-sm text-gray-800 font-semibold">Total: ₱${parseFloat(order.total_amount).toFixed(2)}</div>
                <div class="text-xs text-gray-500 mt-1">Order Date: ${new Date(order.order_date).toLocaleDateString()}</div>
              </div>
            `;
            previousOrdersList.appendChild(li);
            
          } else if (order.order_status === "confirmed") {
            li.className = "border border-gray-300 p-4 rounded-lg bg-gray-50 shadow-sm text-sm text-gray-800 font-medium";
            li.innerHTML = `
              <div class="space-y-2">
                ${items}
                <div class="text-sm text-gray-800 font-semibold">Total: ₱${parseFloat(order.total_amount).toFixed(2)}</div>
                <div class="text-xs text-gray-500 mt-1">Order Date: ${new Date(order.order_date).toLocaleDateString()}</div>
              </div>
            `;
            confirmedOrdersList.appendChild(li);
            
          } else if (order.order_status === "pending") {
            // Special styling for pending orders with cancel button
            li.className = "border border-gray-300 p-4 rounded-lg bg-gray-50 shadow-sm text-sm text-gray-800 font-medium";
            li.innerHTML = `
              <div class="flex justify-between items-start">
                <div class="flex-1 space-y-2">
                  ${items}
                  <div class="text-sm text-gray-800 font-semibold">Total: ₱${parseFloat(order.total_amount).toFixed(2)}</div>
                  <div class="text-xs text-gray-500 mt-1">Order Date: ${new Date(order.order_date).toLocaleDateString()}</div>
                </div>
                <button 
                  onclick="cancelOrder(${order.order_id})" 
                  class="ml-4 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-md transition-colors duration-200 flex-shrink-0"
                  title="Cancel Order"
                >
                  Cancel
                </button>
              </div>
            `;
            ordersToPayList.appendChild(li);
          }
        });

        // Empty states
        if (previousOrdersList.innerHTML === "") {
          previousOrdersList.innerHTML = "<li class='text-gray-500 text-sm'>No completed orders yet.</li>";
        }
        if (ordersToPayList.innerHTML === "") {
          ordersToPayList.innerHTML = "<li class='text-gray-500 text-sm'>No pending orders yet.</li>";
        }
        if (confirmedOrdersList.innerHTML === "") {
          confirmedOrdersList.innerHTML = "<li class='text-gray-500 text-sm'>No confirmed orders yet.</li>";
        }
      })
      .catch(error => {
        console.error("Error loading orders:", error);
        document.getElementById("previous-orders-list").innerHTML = "<li class='text-red-500 text-sm'>Error loading orders.</li>";
        document.getElementById("orders-to-pay-list").innerHTML = "<li class='text-red-500 text-sm'>Error loading orders.</li>";
        document.getElementById("confirmed-orders-list").innerHTML = "<li class='text-red-500 text-sm'>Error loading orders.</li>";
      });
  }
</script>

</body>
</html>