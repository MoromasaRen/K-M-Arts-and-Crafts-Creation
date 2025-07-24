<?php require_once '../../backend/session_keep_alive.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Order Process - KM Arts and Crafts</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: "Roboto Mono", sans-serif;
      }
    </style>
  </head>
  <body class="bg-white text-[#1a2e4a] m-0 p-0">
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
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
      </nav>

      <!-- Login button on the right -->
      <div id="auth-button" class="ml-auto flex-shrink-0"></div>
    </header>

    <!-- Responsive divider under header -->
    <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3;"></div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-20 mb-20 px-6 space-y-12 text-[#1a2e4a] font-semibold">
      <h1 class="text-4xl font-bold mb-8 text-center">Order Process</h1>

      <!-- Step 1 Card -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white">
        <h2 class="text-2xl font-bold mb-4">Step 1: Customer Inquiry & Product Selection</h2>
        <p class="mb-2">📩 <strong>Message Us to Start Your Order</strong></p>
        <p>Send us a message to ask about product availability.</p>
        <p class="mt-2 italic text-sm">
          Please note: responses might take a little time due to scheduling, but we will get back to you.
        </p>
        <p class="mt-4">
          After confirming we're available, we will send:
        </p>
        <ul class="list-disc list-inside ml-4">
          <li>A catalog of flowers/products with names and sample images.</li>
          <li>A price list to guide your selection.</li>
        </ul>
        <p class="mt-4">👉 Tip: You can screenshot the flower you like or note down the name of your chosen design.</p>
      </div>

      <!-- Step 2 Card -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white">
        <h2 class="text-2xl font-bold mb-4">Step 2: Provide Delivery Information</h2>
        <p class="mb-2">🚚 <strong>Send Us Your Delivery Details</strong></p>
        <p>Once you've chosen your item, we’ll confirm its availability.</p>
        <p class="mt-2">
          We will then send a Google Form or delivery form to collect the following:
        </p>
        <ul class="list-disc list-inside ml-4">
          <li>Name</li>
          <li>Contact Number</li>
          <li>Address</li>
          <li>Preferred Delivery Date and Time</li>
          <li>Special Requests (if any)</li>
        </ul>
      </div>

      <!-- Step 3 Card -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white">
        <h2 class="text-2xl font-bold mb-4">Step 3: Choose Your Payment Method</h2>
        <p class="mb-2">💳 <strong>Payment Options Based on Order Total</strong></p>
        <p>After form submission, we’ll send our GCASH number or bank account details for payment.</p>
        <p class="mt-2 font-semibold">Payment Notes:</p>
        <ul class="list-disc list-inside ml-4">
          <li>🧾 Orders ₱300 and below: Can be Cash on Delivery (COD) or Pick-up</li>
          <li>💰 Orders above ₱300: Requires 50% down payment or full payment to secure your order</li>
        </ul>
        <p class="mt-2 font-semibold">Delivery Options:</p>
        <ul class="list-disc list-inside ml-4">
          <li>🛵 Via Maxim</li>
          <li>📍 Pick-up is also available</li>
        </ul>
      </div>
    </main>
    <footer class="bg-[#183655] text-white py-8">
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



</script>

  </body>
</html>
