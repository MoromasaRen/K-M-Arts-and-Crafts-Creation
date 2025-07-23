<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Address Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>
<body class="bg-[#c1d5e9] text-[#1f2d47] m-0 p-0">
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
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
    </nav>

    <!-- Login button on the right -->
    <div id="auth-button" class="ml-auto flex-shrink-0"></div>
  </header>

  <section class="bg-[#1c2f4a] text-white flex justify-center p-3 font-bold text-sm">
    <div class="flex items-center gap-6">
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="w-8 h-8 border-2 border-white text-white rounded-lg flex items-center justify-center font-bold hover:bg-white hover:text-[#1c2f4a] transition">1</a>
        <span>Cart</span>
      </div>
      <div class="h-[1px] w-12 bg-white"></div>
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartAddress.php" class="w-8 h-8 bg-white text-[#1c2f4a] rounded-lg flex items-center justify-center font-bold hover:bg-[#c7d9f9] hover:text-[#1a3550] transition">2</a>
        <span>Address</span>
      </div>
      <div class="h-[1px] w-12 bg-white"></div>
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartPayment.php" class="w-8 h-8 border-2 border-white text-white rounded-lg flex items-center justify-center font-bold">3</a>
        <span>Payment</span>
      </div>
    </div>
  </section>

  <main class="max-w-4xl mx-auto mt-6 px-6">
    <section class="address-card bg-white border border-gray-300 rounded-lg p-6 shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-[#1f2d47] font-semibold text-lg">My Addresses</h2>
        <button id="openModalBtn" class="bg-white border border-gray-400 rounded px-4 py-1 text-sm hover:bg-gray-100 transition">Add New Address +</button>
      </div>
      <div class="address-book">
        <div class="address-book-item mb-4 p-4 border-b border-gray-300 last:border-b-0 flex justify-between items-start">
          <div>
            <p><strong>Laurenz Palanas</strong> | 09123455678</p>
            <p> SLT Compound 9W27+JV4, Florencio Drive, Cebu City, 6000 Cebu </p>
          </div>
          <button 
              class="use-address border border-gray-400 rounded px-4 py-1 text-sm hover:bg-gray-100 transition"
              data-name="Laurenz Palanas"
              data-phone="09123455678"
              data-address="25 Santolan Street, Barangay San Roque, Marikina City, Metro Manila"
            >
              Use address
            </button>
        </div>
        <div class="address-book-item mb-4 p-4 border-b border-gray-300 last:border-b-0 flex justify-between items-start">
          <div>
            <p><strong>Ren Moromasa</strong> | 09123455678</p>
            <p>25 Santolan Street, Barangay San Roque, Marikina City, Metro Manila</p>
          </div>
         <button 
              class="use-address border border-gray-400 rounded px-4 py-1 text-sm hover:bg-gray-100 transition"
              data-name="Ren Moromasa"
              data-phone="09123455678"
              data-address="25 Santolan Street, Barangay San Roque, Marikina City, Metro Manila"
            >
              Use address
            </button>
        </div>
        <div class="address-book-item mb-4 p-4 border-b border-gray-300 last:border-b-0 flex justify-between items-start">
          <div>
            <p><strong>Cedrick Lord Cuas</strong> | 09123455678</p>
            <p>25 Santolan Street, Barangay San Roque, Marikina City, Metro Manila</p>
          </div>
         <button 
              class="use-address border border-gray-400 rounded px-4 py-1 text-sm hover:bg-gray-100 transition"
              data-name="Cedrick Lord Cuas"
              data-phone="09123455678"
              data-address="25 Santolan Street, Barangay San Roque, Marikina City, Metro Manila"
            >
              Use address
            </button>
        </div>
      </div>
    </section>

    <div class="mt-6 flex justify-between">
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="bg-white text-[#1f2d47] font-semibold py-2 px-6 rounded hover:bg-gray-100 transition duration-300 ease-in-out">Back</a>
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartPayment.php" class="bg-[#1f2d47] text-white font-semibold py-2 px-6 rounded hover:bg-[#0f1a2a] transition duration-300 ease-in-out">Next</a>
    </div>

    <!-- Modal -->
    <div id="addressModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
      <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg relative">
        <button id="closeModalBtn" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
        <h2 class="text-[#1f2d47] font-semibold text-lg mb-4">Add New Address</h2>
        <form class="flex flex-col gap-4">
          <input placeholder="Name" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <input placeholder="City (required)" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <input placeholder="Province (required)" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <input placeholder="Road (required)" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <input placeholder="Mobile number (required)" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <input placeholder="Additional Information (Optional)" type="text" class="p-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1f2d47]" />
          <button type="button" class="bg-[#1f2d47] text-white font-semibold py-2 rounded hover:bg-[#0f1a2a] transition duration-300 ease-in-out">Add Address</button>
        </form>
      </div>
    </div>
    <script>
      const openModalBtn = document.getElementById('openModalBtn');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const addressModal = document.getElementById('addressModal');

      openModalBtn.addEventListener('click', () => {
        addressModal.classList.remove('hidden');
      });

      closeModalBtn.addEventListener('click', () => {
        addressModal.classList.add('hidden');
      });

      // Optional: Close modal when clicking outside the modal content
      addressModal.addEventListener('click', (e) => {
        if (e.target === addressModal) {
          addressModal.classList.add('hidden');
        }
      });
    </script>
  </main>

  
        <!-- Footer -->
     <div class="mt-16"></div>
    <footer class="bg-[#183655] text-white py-8">
      <div class="max-w-screen-xl mx-auto px-6 flex flex-col items-center justify-center text-center space-y-6">
        <!-- Logo -->
        <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo3.png" alt="KM Arts & Crafts Creation Logo" class="w-80 h-auto" />

        <!-- Social Media Icons -->
        <div class="flex gap-6">
          <a href="https://www.instagram.com/kmartsandcraftscreation/" target="_blank" aria-label="Instagram">
            <img src="/K-M-Arts-and-Crafts-Creation/assets/InstaIconWhite.png" alt="Instagram" class="w-11 h-11" />
          </a>
          <a href="https://www.facebook.com/stumoniii" target="_blank" aria-label="Facebook">
            <img src="/K-M-Arts-and-Crafts-Creation/assets/FacebookIconWhite.png" alt="Facebook" class="w-11 h-11" />
          </a>
          <a href="https://www.tiktok.com/@kmartsandcraftscreation" target="_blank" aria-label="TikTok">
            <img src="/K-M-Arts-and-Crafts-Creation/assets/TikTokIconWhite.png" alt="TikTok" class="w-11 h-11" />
          </a>
        </div>

        <!-- Copyright -->
        <p class="text-sm tracking-widest">2025 KM ARTS & CRAFTS. All rights reserved.</p>
      </div>
    </footer>
    
</body>

<script>
const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
const authButton = document.getElementById('auth-button');

if (isLoggedIn) {
  // Show profile icon
  authButton.innerHTML = `
    <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Profile.php">
      <img
        src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
        alt="Profile"
        class="w-10 h-10 rounded-full object-cover border-2 border-[#1a3550]"
        title="My Profile"
      />
    </a>
  `;
} else {
  // Show Login/Register
  authButton.innerHTML = `
    <a href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html">
      <button
        class="border border-[#1a2e4a] rounded-full px-5 py-1 text-[13px] font-semibold text-[#1a2e4a] hover:bg-[#c7d9f9] whitespace-nowrap"
      >
        Login/Register
      </button>
    </a>
  `;
}



 const addressButtons = document.querySelectorAll(".use-address");

addressButtons.forEach(button => {
  button.addEventListener("click", () => {
    const selectedAddress = {
      name: button.getAttribute("data-name"),
      phone: button.getAttribute("data-phone"),
      address: button.getAttribute("data-address")
    };

    // Save to localStorage
    localStorage.setItem("selectedAddress", JSON.stringify(selectedAddress));
    alert("Address selected!");

    // Hide all "Use address" buttons first
    addressButtons.forEach(btn => btn.style.display = "inline-block"); // Show all first

    // Then hide only the clicked one
    button.style.display = "none";
  });
});


// Check if there's a selected address in localStorage when page loads
window.addEventListener("DOMContentLoaded", () => {
  const selectedAddress = JSON.parse(localStorage.getItem("selectedAddress"));

  if (selectedAddress) {
    addressButtons.forEach(button => {
      const name = button.getAttribute("data-name");
      const phone = button.getAttribute("data-phone");
      const address = button.getAttribute("data-address");

      if (
        selectedAddress.name === name &&
        selectedAddress.phone === phone &&
        selectedAddress.address === address
      ) {
        button.style.display = "none"; // Hide the button for the selected one
      } else {
        button.style.display = "inline-block"; // Show for others
      }
    });
  } else {
    // No address was selected yet, pick first one by default
    const defaultBtn = addressButtons[0];
    const defaultAddress = {
      name: defaultBtn.getAttribute("data-name"),
      phone: defaultBtn.getAttribute("data-phone"),
      address: defaultBtn.getAttribute("data-address")
    };

    localStorage.setItem("selectedAddress", JSON.stringify(defaultAddress));
    defaultBtn.style.display = "none";
  }
});


  // Step 1: Get user_id from localStorage
  const userId = localStorage.getItem('user_id');

  // Step 2: Redirect to login if user_id is missing
  if (!userId) {
    alert("You must be logged in to enter your address!");
    window.location.href = "/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html";
  }

  const profileDiv = document.createElement('div');
  document.body.insertBefore(profileDiv, document.body.firstChild);

</script>

</html>
