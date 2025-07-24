<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>K&amp;M Arts &amp; Crafts Creation</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: "Roboto Mono", monospace;
      }

      
      #product-scroll {
        scrollbar-width: none; 
        -ms-overflow-style: none; /* IE 10+ */
      }
      #product-scroll::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
      }
    </style>
  </head>

  <body class="bg-white text-[#1a3550]">
    <header class="flex items-center justify-between p-4 sm:p-8 bg-white w-full">
      <!-- Logo (Aligned left) -->
      <div class="flex items-center">
        <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
      </div>

      <!-- Navigation in the center -->
      <nav class="flex gap-8 text-[17px] font-semibold justify-center flex-wrap flex-grow">
        <a href="/K-M-Arts-and-Crafts-Creation/index.php" class="bg-[#c7d9f9] px-3 py-1 rounded">Home</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Shop.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Shop</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Contacts.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Contact</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/About.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">About Us</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
      </nav>

    <!-- Login button on the right --> 
     <!-- // create a condition where if there is no account logged in, it will display the Login/Register button. but if an account is logged in/
     it will change to profile icon -->
    <!-- <a href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html" class="ml-auto flex-shrink-0">
      <button
        class="border border-[#1a2e4a] rounded-full px-5 py-1 text-[13px] font-semibold text-[#1a2e4a] hover:bg-[#c7d9f9] whitespace-nowrap"
      >
        Login/Register
      </button>
    </a> -->

    <div class="ml-auto flex-shrink-0">
  <?php
  if (isset($_SESSION['user_id'])) {
    echo '
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Profile.php">
        <img
          src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
          alt="Profile"
          class="w-10 h-10 rounded-full object-cover border-2 border-[#1a3550]"
          title="My Profile"
        />
      </a>
    ';
  } else {
    echo '
      <a href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html">
        <button class="border border-[#1a2e4a] rounded-full px-5 py-1 text-[13px] font-semibold text-[#1a2e4a] hover:bg-[#c7d9f9] whitespace-nowrap">
          Login/Register
        </button>
      </a>
    ';
  }
  ?>
</div>

  </header>

    <!-- Responsive divider under header -->
    <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3"></div>

    <!-- Banner Section -->
    <section class="max-w-screen-xl mx-auto px-6 py-16 flex flex-col items-start gap-6">
      <img src="/K-M-Arts-and-Crafts-Creation/assets/homepage.png" alt="KM Logo" class="w-[1600px] h-auto object-contain" />
    </section>

    <!-- Best Sellers Section -->
    <section class="bg-[#d3e4fb] border-t-4 border-b-4 border-[#1a3550] py-16">
      <div class="max-w-screen-xl mx-auto flex flex-col lg:flex-row gap-10 px-6">
        <!-- Left Side -->
        <div class="flex flex-col gap-6 lg:w-1/3 w-full">
          <h2 class="text-5xl md:text-7xl font-extrabold text-[#1a3550] leading-tight">
            Best<br />Sellers
          </h2>
          <div class="border-t-2 border-[#1a3550] w-64 md:w-96 my-2"></div>
          <p class="text-xl md:text-2xl font-semibold tracking-wide text-[#1a3550] uppercase">
            A PERFECT GIFT FOR YOUR<br />LOVED ONES
          </p>
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo(Transparant).png" class="w-full max-w-[700px] h-auto" alt="Logo Transparent" />
        </div>

        <!-- Right Side -->
        <div class="lg:w-2/3 w-full relative px-10">
          <!-- Left Arrow -->
          <button id="scroll-left" aria-label="Scroll left" style="top: 35%; transform: translateY(-50%) translateX(-20%)"
            class="absolute left-0 bg-transparent text-[#1a3550] rounded-full p-3 z-20 hover:bg-transparent hover:text-[#12243b] transition">
            <span class="material-symbols-outlined">arrow_back_ios</span>
          </button>

          <!-- Scrollable Product Cards -->
          <div id="product-scroll" class="flex flex-nowrap gap-6 items-center overflow-x-auto scroll-smooth pb-8 justify-center">
           <!-- Product 1 -->
<div class="flex-shrink-0 w-64 bg-white border border-gray-300 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition-all relative">
  <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/1.png" alt="Blue Orchid Bouquet" class="rounded-lg w-full h-48 object-cover mb-4" />
  <h3 class="text-lg font-semibold mb-2">Blue Orchid Bouquet</h3>
  <div class="text-[#1a3550] text-base font-bold mb-2">P385</div>
  <div class="flex gap-2">
    
  </div>
</div>

<!-- Product 2 -->
<div class="flex-shrink-0 w-64 bg-white border border-gray-300 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition-all relative">
  <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/2.png" alt="Sunflower Delight" class="rounded-lg w-full h-48 object-cover mb-4" />
  <h3 class="text-lg font-semibold mb-2">Sunflower Delight</h3>
  <div class="text-[#1a3550] text-base font-bold mb-2">P420</div>
  <div class="flex gap-2">
    
  </div>
</div>

<!-- Product 3 -->
<div class="flex-shrink-0 w-64 bg-white border border-gray-300 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition-all relative">
  <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/3.png" alt="Pink Roses Box" class="rounded-lg w-full h-48 object-cover mb-4" />
  <h3 class="text-lg font-semibold mb-2">Pink Roses Box</h3>
  <div class="text-[#1a3550] text-base font-bold mb-2">P480</div>
  <div class="flex gap-2">
    
  </div>
</div>

<!-- Product 4 -->
<div class="flex-shrink-0 w-64 bg-white border border-gray-300 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition-all relative">
  <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/4.png" alt="Lavender Love" class="rounded-lg w-full h-48 object-cover mb-4" />
  <h3 class="text-lg font-semibold mb-2">Lavender Love</h3>
  <div class="text-[#1a3550] text-base font-bold mb-2">P365</div>
  <div class="flex gap-2">
    
  </div>
</div>

<!-- Product 5 -->
<div class="flex-shrink-0 w-64 bg-white border border-gray-300 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition-all relative">
  <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/5.png" alt="Rainbow Tulips" class="rounded-lg w-full h-48 object-cover mb-4" />
  <h3 class="text-lg font-semibold mb-2">Rainbow Tulips</h3>
  <div class="text-[#1a3550] text-base font-bold mb-2">P399</div>
  <div class="flex gap-2">
    
  </div>
</div>


          <!-- Right Arrow -->
          <button id="scroll-right" aria-label="Scroll right" style="top: 35%; transform: translateY(-50%) translateX(40%)"
            class="absolute right-0 bg-transparent text-[#1a3550] rounded-full p-3 z-20 hover:bg-transparent hover:text-[#12243b] transition">
            <span class="material-symbols-outlined">arrow_forward_ios</span>
          </button>
        </div>
      </div>
    </section>

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

    <!-- Scroll Logic -->
    <script>
      const scrollContainer = document.getElementById("product-scroll");
      const scrollLeftBtn = document.getElementById("scroll-left");
      const scrollRightBtn = document.getElementById("scroll-right");

      const scrollAmount = 300;

      scrollLeftBtn.addEventListener("click", () => {
        scrollContainer.scrollBy({ left: -scrollAmount, behavior: "smooth" });
      });

    scrollRightBtn.addEventListener('click', () => {
      scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });




  // const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
  // const authButton = document.getElementById('auth-button');

  // if (isLoggedIn) {
  //   // Show profile icon
  //   authButton.innerHTML = `
  //     <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Profile.php">
  //       <img
  //         src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
  //         alt="Profile"
  //         class="w-10 h-10 rounded-full object-cover border-2 border-[#1a3550]"a
  //         title="My Profile"
  //       />
  //     </a>
  //   `;
  // } else {
  //   // Show Login/Register
  //   authButton.innerHTML = `
  //     <a href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Login.html">
  //       <button
  //         class="border border-[#1a2e4a] rounded-full px-5 py-1 text-[13px] font-semibold text-[#1a2e4a] hover:bg-[#c7d9f9] whitespace-nowrap"
  //       >
  //         Login/Register
  //       </button>
  //     </a>
  //   `;
  // }

  function addToCart(product) {
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

    const existingProduct = cartItems.find(item => item.id === product.id);

    if (existingProduct) {
      existingProduct.quantity += 1;
    } else {
      product.quantity = 1;
      cartItems.push(product);
    }

    localStorage.setItem("cartItems", JSON.stringify(cartItems));
    showAddToCartModal(product.name);
  }

  function showAddToCartModal(itemName) {
  // Remove any existing modal
  const existingModal = document.getElementById("addToCartModal");
  if (existingModal) existingModal.remove();

  // Create modal wrapper
  const modalWrapper = document.createElement("div");
  modalWrapper.id = "addToCartModal";
  modalWrapper.className = "fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50";

  // Modal content
  modalWrapper.innerHTML = `
    <div class="bg-white text-[#1f2d47] rounded-lg p-6 w-80 text-center shadow-lg animate-fadeIn">
      <h3 class="text-xl font-semibold mb-2">Added to Cart</h3>
      <p class="text-sm mb-4">${itemName} has been added to your cart.</p>
      <button class="mt-2 bg-[#1f2d47] text-white px-4 py-2 rounded hover:bg-[#324d6e] transition duration-300">
        OK
      </button>
    </div>
  `;

  // Append modal to body
  document.body.appendChild(modalWrapper);

  // Close button handler
  modalWrapper.querySelector("button").addEventListener("click", () => {
    modalWrapper.remove();
  });

  // Optional: Auto-close after 2.5 seconds
  setTimeout(() => {
    if (modalWrapper.parentNode) modalWrapper.remove();
  }, 2500);
}




  </script>
</body>
</html>
