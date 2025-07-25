<?php require_once '../../backend/session_keep_alive.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KM Arts and Crafts About</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
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
        <img src="../../assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
      </div>

      <!-- Navigation in the center -->
      <nav class="flex gap-8 text-[17px] font-semibold justify-center flex-wrap flex-grow">
        <a href="/K-M-Arts-and-Crafts-Creation/index.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Home</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Shop.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Shop</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Contacts.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Contact</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/About.php" class="bg-[#c7d9f9] px-3 py-1 rounded">About Us</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
      </nav>

      <!-- Login button on the right -->
      <div id="auth-button" class="ml-auto flex-shrink-0"></div>
    </header>

    <!-- Responsive divider under header -->
    <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3;"></div>

    <!-- Main -->
    <main class="max-w-7xl mx-auto mt-12 px-6 text-center">
      <img
        src="/K-M-Arts-and-Crafts-Creation/assets/About Us/1.png"
        alt="K and M Arts and Crafts Creation logo"
        class="mb-8 w-full max-w-[2000px] h-auto object-contain"
      />
    </main>

    <!-- About Sections -->
    <section class="max-w-6xl mx-auto mt-20 px-6 space-y-8 text-[#1a2e4a] font-semibold">
      <!-- Section 1: My Story -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white flex flex-col md:flex-row items-center gap-8">
        <div class="md:w-1/3">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/About Us/owner picture.png" alt="Owner Kimberly" class="rounded-lg shadow-lg w-full object-cover" />
        </div>
        <div class="md:w-2/3 text-left">
          <h2 class="text-3xl font-bold mb-4">My Story</h2>
          <p>Hi, I’m Kimberly — the founder of KM Arts and Crafts.</p>
          <p class="mt-2">
            In 2023, what began as a personal love for flowers turned into a meaningful business.
            As a computer engineering student at the time, I started crafting and selling floral
            arrangements from home. I didn’t just see flowers—I saw a way for people to express
            their feelings without needing to spend a lot. That belief planted the roots of this
            business.
          </p>
        </div>
      </div>

      <!-- Section 3: What We Do -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white">
        <h2 class="text-3xl font-bold mb-4">What We Do</h2>
        <p>
          At KM Arts and Crafts, we offer handcrafted floral products designed to express love, thoughtfulness, and
          connection. From simple roses to elegant grand arrangements, every bouquet is made with heart and
          purpose. We focus on affordability—because we believe that it's not the price that makes a gift special, but
          the emotion behind it.
        </p>
        <p class="mt-2">
          Whether it’s for birthdays, anniversaries, comfort, or just because—you’ll find flowers here that speak
          louder than words.
        </p>
      </div>

      <!-- Section 4: What’s Next -->
      <div class="border border-gray-300 rounded-lg shadow-lg p-6 bg-white">
        <h2 class="text-3xl font-bold mb-4">What’s Next</h2>
        <p>
          Our vision is to grow KM Arts and Crafts into a brand known for making expression accessible to everyone. In the future, we plan to expand our product line, collaborate with other local creatives, and make our services even more convenient through online orders and personalized gifting.
        </p>
        <p class="mt-2">
          No matter how we grow, one thing stays the same:
        </p>
        <p class="mt-2 font-semibold italic">
          Our mission to help people show their love in the most genuine—and affordable—way possible.
        </p>
      </div>
    </section>
<Footer>
  <footer class="bg-[#183655] text-white py-8 mt-16">
    <div class="max-w-screen-xl mx-auto px-6 flex flex-col items-center justify-center text-center space-y-6">
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



</script>

  </body>
</html>
