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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Payment Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body {
      height: 100%; /* Ensure html and body are full height */
    }
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>
<body class="bg-[#c6d9f7] text-[#1f3a5f] m-0 p-0 min-h-screen flex flex-col">
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
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartAddress.php" class="w-8 h-8 border-2 border-white text-white rounded-lg flex items-center justify-center font-bold hover:bg-white hover:text-[#1c2f4a] transition">2</a>
        <span>Address</span>
      </div>
      <div class="h-[1px] w-12 bg-white"></div>
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartPayment.php" class="w-8 h-8 bg-white text-[#1c2f4a] rounded-lg flex items-center justify-center font-bold hover:bg-[#c7d9f9] hover:text-[#1a3550] transition">3</a>
        <span>Payment</span>
      </div>
    </div>
  </section>


  <main class="flex-1 max-w-7xl mx-auto mt-8 px-6 flex flex-col md:flex-row gap-6 justify-center items-start">
    <!-- Payment Details -->
    <section class="bg-white border border-gray-300 rounded-lg p-6 w-full md:w-[320px]">
      <h2 class="font-semibold text-[#1c2f4a] mb-4 text-base">Payment Details</h2>
      <div class="border-b border-gray-300 pb-2 mb-2 font-bold text-[#1c2f4a] cursor-pointer">Cash on Delivery</div>
      <!-- <div class="border-b border-gray-300 pb-2 mb-2 font-bold text-[#1c2f4a] cursor-pointer">Pay with card</div>
      <div>
        <div class="font-bold mb-2 text-[#1c2f4a]">Card Details:</div>
        <div class="text-sm mb-1">Card Number: [•••• •••• •••• 1234]</div>
        <div class="text-sm mb-1">Expiry: [MM/YY] &nbsp; CVV: [123]</div>
        <div class="text-sm mb-1">Cardholder Name: [________]</div>
      </div> -->
    </section>
  
    <!-- Order Summary -->
    <section class="bg-white border border-gray-300 rounded-lg p-6 w-full md:w-[320px] flex flex-col justify-between">
      <h2 class="font-semibold text-[#1c2f4a] mb-4 text-base">Order summary</h2>
      <div id="orderItems" class="flex flex-col gap-2 mb-2 text-sm">
        <!-- Cart items will be populated here -->
      </div>
      <div class="flex justify-between"><span>Delivery fee:</span><span>₱0</span></div>
      <div class="flex justify-between"><span>Coupon:</span><span>N/A</span></div>
      <hr class="my-2"/>
      <div class="flex justify-between font-bold text-base mb-4">
        <span>Total:</span>
        <span id="payment-total">₱0.00</span>
      </div>
      <div class="flex justify-between mt-2">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartAddress.php" class="bg-gray-300 text-[#1f3a5f] font-semibold py-2 px-6 rounded hover:bg-gray-400 transition duration-300 ease-in-out">Back</a>
        <button id="submitOrderBtn" class="bg-[#f2f7fd] border border-gray-400 rounded py-2 px-6 font-semibold text-[#1c2f4a] hover:bg-[#c7d9f9] transition">
          Place Order
        </button>
      </div>
    </section>
  </main>

  <!-- Success Modal -->
<div id="orderSuccessModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-xl text-center max-w-sm w-full">
    <h2 class="text-xl font-semibold mb-2 text-green-700">Order Successfully Placed!</h2>
    <p class="text-gray-700 mb-4">Thank you for ordering from KM Arts & Crafts.</p>
    <button onclick="closeModal()" class="bg-[#1f3a5f] text-white px-4 py-2 rounded hover:bg-[#2d4f77] transition">
      Close
    </button>
  </div>
</div>

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

          <script>
            // Debug: confirm script loaded
            console.log("Script loaded!");
          
            const userId = localStorage.getItem('user_id');
            if (!userId) {
              alert("You must be logged in to proceed to payment!");
              window.location.href = "/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html";
            }
          
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
          
            // Debug: confirm about to attach event listener
            console.log("About to attach event listener");
            const total = localStorage.getItem("totalPrice") || "0.00";
            document.getElementById("payment-total").textContent = `₱${total}`;
          
            // Make sure the element exists before attaching the event listener
            const submitOrderBtn = document.getElementById("submitOrderBtn");
            if (submitOrderBtn) {
              submitOrderBtn.addEventListener("click", function () {
                console.log("Place Order button CLICKED!"); // Debug
                const cart = JSON.parse(localStorage.getItem("cart")) || [];
                const userId = localStorage.getItem("user_id");
          
                if (!userId || cart.length === 0) {
                  alert("Missing user or cart is empty.");
                  return;
                }
          
                const items = cart.map(item => ({
                  product_id: item.id,
                  quantity: item.quantity,
                  price: item.price,
                  total_units: item.quantity * item.price
                }));
          
                const totalAmount = items.reduce((sum, item) => sum + item.total_units, 0);
                const orderDetails = items.map(i => `#${i.product_id} x${i.quantity}`).join(", ");
          
                // Debug: log order data before sending
                console.log("Order Data:", {
                  user_id: userId,
                  order_details: orderDetails,
                  total_amount: totalAmount,
                  items: items
                });
          
                fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/orders/submit_order.php", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({
                    user_id: userId,
                    order_details: orderDetails,
                    total_amount: totalAmount,
                    items: items
                  })
                })
                .then(res => {
                  // Debug: raw response
                  console.log("Raw fetch response:", res);
                  return res.json().catch(() => {
                    console.error("Invalid JSON from backend");
                    alert("Server error: Invalid response format.");
                    throw new Error("Invalid JSON");
                  });
                })
                .then(data => {
                  console.log("Order Response:", data);
                  if (data.success) {
                    localStorage.removeItem("cart");
                    showSuccessModal();
                  } else {
                    console.error("Error:", data);
                    alert("Order failed: " + (data.error || "Unknown error"));
                  }
                })
                .catch(err => {
                  console.error("Network error or fetch failed:", err);
                });
              });
            } else {
              console.error("submitOrderBtn not found!");
            }
          
            function showSuccessModal() {
              const modal = document.getElementById('orderSuccessModal');
              if (modal) {
                modal.classList.remove('hidden');
              }
            }
          
            function closeModal() {
              const modal = document.getElementById('orderSuccessModal');
              if (modal) {
                modal.classList.add('hidden');
              }
            }


            document.addEventListener("DOMContentLoaded", () => {
                const cart = JSON.parse(localStorage.getItem("cart")) || [];
                const orderItemsContainer = document.getElementById("orderItems");
                const totalDisplay = document.getElementById("payment-total");

                let total = 0;

                cart.forEach(item => {
                  const subtotal = item.price * item.quantity;
                  total += subtotal;

                  const itemRow = document.createElement("div");
                  itemRow.className = "flex justify-between";

                  itemRow.innerHTML = `
                    <span>${item.name} x${item.quantity}</span>
                    <span>₱${subtotal.toFixed(2)}</span>
                  `;

                  orderItemsContainer.appendChild(itemRow);
                });

                totalDisplay.textContent = `₱${total.toFixed(2)}`;
                localStorage.setItem("totalPrice", total.toFixed(2));
              });
          </script>
</body>
</html>
