<?php
session_start();

$timeout_duration = 900;

if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('You must be logged in to access the cart.'); window.location.href='/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html';</script>";
  exit;
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  session_unset();
  session_destroy();
  echo "<script>alert('Your session has expired. Please log in again.'); window.location.href='/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html';</script>";
  exit;
}

$_SESSION['LAST_ACTIVITY'] = time();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Cart Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Roboto Mono', sans-serif;
    }
  </style>
</head>
<body class="bg-[#1c2f4a] text-[#1c2f4a] min-h-screen flex flex-col">

  <!-- Header (Updated) -->
  <header class="flex items-center justify-between p-4 sm:p-8 bg-white w-full">
    <!-- Logo (Aligned left) -->
    <div class="flex items-center">
      <img src="../../assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
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

  <!-- Progress Bar -->
  <section class="bg-[#1c2f4a] text-white flex justify-center p-3 font-bold text-sm">
    <div class="flex items-center gap-6">
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="w-8 h-8 bg-white text-[#1c2f4a] rounded-lg flex items-center justify-center font-bold hover:bg-[#c7d9f9] hover:text-[#1a3550] transition">1</a>
        <span>Cart</span>
      </div>
      <!-- <div class="h-[1px] w-12 bg-white"></div>
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartAddress.php" class="w-8 h-8 border-2 border-white text-white rounded-lg flex items-center justify-center font-bold">2</a>
        <span>Address</span>
      </div> -->
      <div class="h-[1px] w-12 bg-white"></div>
      <div class="flex flex-col items-center gap-1">
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartPayment.php" class="w-8 h-8 border-2 border-white text-white rounded-lg flex items-center justify-center font-bold">2</a>
        <span>Payment</span>
      </div>
    </div>
  </section>


  <!-- Main Content -->
  <div class="bg-[#c6d9f7] flex-1">
    <main class="flex justify-center items-start flex-col md:flex-row gap-8 py-10 px-6 max-w-6xl mx-auto w-full"> 
      <!-- Items Section -->
      <section class="bg-white border border-gray-300 rounded-lg p-6 w-full md:max-w-[28rem] shadow">
       <h2 class="font-semibold text-[#1c2f4a] mb-4 text-base">Items</h2>
        <ul id="cart-list" class="space-y-4"></ul>

      </section>
    
      <!-- Right Section (Coupons & Price Details) -->
      <section class="flex flex-col gap-6 w-full md:max-w-md">
        <!-- Coupon -->
        <div class="bg-white border border-gray-300 rounded-lg p-4 shadow">
          <h2 class="font-semibold text-[#1c2f4a] mb-2 text-base">Coupons</h2>
          <input type="text" placeholder="Enter Gift Code"
                class="w-full border border-gray-400 rounded px-4 py-2 text-base font-bold focus:outline-none focus:ring-2 focus:ring-[#1c2f4a]"/>
        </div>
        <!-- Price Details -->
        <!-- Total Summary Card -->
            <div class="bg-white border border-gray-300 rounded-lg p-4 shadow">
              <h2 class="font-semibold text-[#1c2f4a] mb-4 text-base">Cart Summary</h2>
              <div class="flex justify-between mb-2">
                <span class="font-semibold">Total Items:</span>
                <span id="item-count" class="text-[#1c2f4a] font-bold">0 items</span>
              </div>
              <div class="flex justify-between">
                <span class="font-semibold">Total Price:</span>
                <span id="total-amount" class="text-[#1c2f4a] font-bold">₱0.00</span>
              </div>
            </div>
          <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/CartPayment.php">
            <button class="mt-4 w-full bg-white border border-gray-400 rounded py-2 font-bold text-[#1c2f4a] hover:bg-[#c6d9f7] transition">NEXT</button>
          </a>
        </div>
      </section>
    </main>
  </div>

  
    <!-- Footer -->
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



  const cartList = document.getElementById("cart-list");
  const totalAmountSpan = document.getElementById("total-amount");
  const itemCountSpan = document.getElementById("item-count");

  function loadCart() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    cartList.innerHTML = "";

    let totalItems = 0;
    let totalPrice = 0;

    cart.forEach((item, index) => {
      totalItems += item.quantity;
      totalPrice += item.quantity * parseFloat(item.price);

      const li = document.createElement("li");
      li.className = "flex items-center border border-gray-300 rounded-lg p-3 gap-4 bg-[#f5f7fa]";
      li.innerHTML = `
        <img src="${item.img}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md"/>
        <div class="flex-grow">
          <div class="font-semibold text-[#1c2f4a]">${item.name}</div>
          <div class="text-sm text-gray-500">₱${item.price}</div>
        </div>
        <button onclick="removeItem(${index})" class="text-[#1c2f4a] font-bold text-lg hover:text-red-600 px-2">×</button>
        <div class="flex items-center gap-1 font-bold text-sm text-gray-700 ml-4">
          <button onclick="decreaseQty(${index})" class="px-2 py-1 rounded hover:bg-gray-200">-</button>
          <input type="number" min="1" max="30" value="${item.quantity}" 
  onchange="updateQty(${index}, this.value)" 
  class="w-12 text-center border border-gray-300 rounded" />
          <button onclick="increaseQty(${index})" class="px-2 py-1 rounded hover:bg-gray-200">+</button>
        </div>
      `;
      cartList.appendChild(li);
    });

    itemCountSpan.textContent = totalItems + " item" + (totalItems !== 1 ? "s" : "");
    totalAmountSpan.textContent = "₱" + totalPrice.toFixed(2);
    localStorage.setItem("totalPrice", totalPrice.toFixed(2));
  }

  function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
  }

  function decreaseQty(index) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (cart[index].quantity > 1) {
      cart[index].quantity -= 1;
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
  }

 function increaseQty(index) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const productId = cart[index].id;
  const currentQty = cart[index].quantity;

  fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/get_product_quantity.php?product_id=${productId}`)
    .then(response => response.json())
    .then(data => {
      const availableQuantity = data.quantity;

      if (currentQty < availableQuantity) {
        cart[index].quantity += 1;
        localStorage.setItem("cart", JSON.stringify(cart));
        loadCart();
      } else {
        alert(`Stock limit reached. Only ${availableQuantity} available.`);
      }
    })
    .catch(error => {
      console.error("Error checking stock:", error);
      alert("Error fetching stock.");
    });
}
function updateQty(index, newQty) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const quantity = parseInt(newQty);

  if (isNaN(quantity) || quantity < 1) {
    alert("Quantity must be at least 1.");
    return;
  }

  const productId = cart[index].id;

  fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/get_product_quantity.php?product_id=${productId}`)
    .then(response => response.json())
    .then(data => {
      const available = data.quantity;

      if (quantity > available) {
        alert(`Only ${available} items are in stock.`);
      } else {
        cart[index].quantity = quantity;
        localStorage.setItem("cart", JSON.stringify(cart));
        loadCart();
      }
    })
    .catch(error => {
      console.error("Error checking stock:", error);
      alert("Error checking stock.");
    });
}

  // Load the cart on page load
  loadCart();

   // Get user_id from localStorage
   const userId = localStorage.getItem('user_id');

// If user_id is missing, optionally redirect to login
if (!userId) {
  alert("You must be logged in to view your cart!");
  window.location.href = "/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html";
}
const profileDiv = document.createElement('div');
document.body.insertBefore(profileDiv, document.body.firstChild);

function addToCart(productId, productName, productPrice, productImg) {
  const userId = localStorage.getItem('user_id'); // Optional: Use for logging or auth

  fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/get_product_quantity.php?product_id=${productId}`)
    .then(response => response.json())
    .then(data => {
      const availableStock = data.quantity;
      const cart = JSON.parse(localStorage.getItem("cart")) || [];

      const existingItem = cart.find(item => item.id === productId);

      let currentQuantity = existingItem ? existingItem.quantity : 0;

      if (currentQuantity < availableStock) {
        if (existingItem) {
          existingItem.quantity++;
        } else {
          cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            img: productImg,
            quantity: 1
          });
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        loadCart(); // refresh UI
        alert("Item added to cart!");
      } else {
        alert("Sorry, not enough stock available!");
      }
    })
    .catch(error => {
      console.error("Error fetching product quantity:", error);
      alert("Error checking stock.");
    });
}


</script>

</body>
</html>