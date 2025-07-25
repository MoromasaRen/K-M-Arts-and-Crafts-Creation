<?php require_once '../../backend/session_keep_alive.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>K&amp;M Arts &amp; Crafts</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: "Roboto Mono", monospace;
    }
  </style>
</head>

<body class="bg-white text-[#1a2e4a] m-0 p-0 min-h-screen">
  <header class="flex items-center justify-between p-4 sm:p-8 bg-white w-full">
    <!-- Logo (Aligned left) -->
    <div class="flex items-center">
      <img src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
    </div>

    <!-- Navigation in the center -->
    <nav class="flex gap-8 text-[17px] font-semibold justify-center flex-wrap flex-grow">
        <a href="/K-M-Arts-and-Crafts-Creation/index.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Home</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Shop.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Shop</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Contacts.php" class="bg-[#c7d9f9] px-3 py-1 rounded">Contact</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/About.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">About Us</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
    </nav>

    <!-- Login button on the right -->
    <div id="auth-button" class="ml-auto flex-shrink-0"></div>

  </header>

  <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3;"></div>

    <section class="max-w-4xl mx-auto mt-16 px-6 space-y-12 text-left text-[#1a2e4a] font-semibold">
      <!-- Section 1 -->
      <div class="bg-white/30 backdrop-blur-md p-6 rounded-md border border-gray-300 border-opacity-30 shadow-lg">
        <h2 class="text-2xl font-bold mb-2">KM Arts &amp; Crafts Creation</h2>
        <p>Looc, Lapu Lapu City Cebu</p>
        <p>Cebu, Visayas Region 7, Philippines</p>
        <hr class="my-4 border-gray-300" />
      </div>

      <!-- Section 2 -->
      <div class="bg-white/30 backdrop-blur-md p-6 rounded-md border border-gray-300 border-opacity-30 shadow-lg">
        <h3 class="text-xl font-bold mb-2">Have Questions, Concerns, or Feedback? We're here to bloom with you!</h3>
        <p>Whether you're curious about our flower arrangements, have concerns about your order, or simply want to share your experience, we’re all ears and petals.</p>
        <p class="mt-2">Let us know how we can make your flower experience more beautiful.</p>
        <hr class="my-4 border-gray-300" />
      </div>

      <!-- Section 3 -->
      <div>
        <div class="flex flex-col md:flex-row gap-6">
          <!-- Card 1 -->
          <div class="bg-white/30 backdrop-blur-md text-[#1a2e4a] p-6 rounded-md flex-1 border border-gray-300 border-opacity-30 shadow-lg">
            <h4 class="font-bold mb-2">Work Days</h4>
            <p>Monday-Friday: 7am-9pm</p>
            <p>Saturday &amp; Sunday: 9am-8pm</p>
          </div>
          <!-- Card 2 -->
          <div class="bg-white/30 backdrop-blur-md text-[#1a2e4a] p-6 rounded-md flex-1 border border-gray-300 border-opacity-30 shadow-lg">
            <h4 class="font-bold mb-2">Social Media Accounts</h4>
            <p><a href="https://web.facebook.com/kimmywishes231" class="underline" target="_blank">Kimberly M. Luistro</a></p>
            <p><a href="https://www.facebook.com/melisa.molina.520" class="underline" target="_blank">Mel Isa</a></p>
          </div>
          <!-- Card 3 -->
          <div class="bg-white/30 backdrop-blur-md text-[#1a2e4a] p-6 rounded-md flex-1 border border-gray-300 border-opacity-30 shadow-lg">
            <h4 class="font-bold mb-2">Phone</h4>
            <p>For Inquiries | 09943270287</p>
            <p>For Reservations | 09943270287</p>
          </div>
        </div>
        <p class="mt-6 italic font-semibold text-center">"Love Doesn’t Have to Be Expensive—Just Expressive."</p>
</section>
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
