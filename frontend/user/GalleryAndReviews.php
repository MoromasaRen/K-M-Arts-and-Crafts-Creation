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
    <title>Gallery & Reviews - KM Arts and Crafts</title>
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
        <img src="../../assets/Logo.png" alt="KM Logo" class="w-[250px] h-auto object-contain" />
      </div>

      <!-- Navigation in the center -->
      <nav class="flex gap-8 text-[17px] font-semibold justify-center flex-wrap flex-grow">
        <a href="/K-M-Arts-and-Crafts-Creation/index.html" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Home</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Shop.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Shop</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Contacts.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Contact</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/About.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">About Us</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/OrderProcess.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Order Process</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/GalleryAndReviews.php" class="bg-[#c7d9f9] px-3 py-1 rounded">Gallery & Reviews</a>
        <a href="/K-M-Arts-and-Crafts-Creation/frontend/user/Cart.php" class="hover:bg-[#c7d9f9] px-3 py-1 rounded">Cart</a>
      </nav>

      <!-- Login button on the right -->
      <div id="auth-button" class="ml-auto flex-shrink-0"></div>
    </header>

    <div class="w-full border-t-2 border-slate-800 my-2" style="opacity: 0.3;"></div>

    <main class="max-w-6xl mx-auto mt-12 px-6">
      <!-- Special KM Collections Section -->
      <section class="mb-12 liquid-glass">
        <h2 class="text-center text-3xl font-extrabold mb-8">
          SPECIAL <br />
          KM COLLECTIONS <br />
          2025
        </h2>
        <div class="grid grid-cols-3 gap-4">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/1.png" alt="Flower 1" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/2.png" alt="Flower 2" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/3.png" alt="Flower 3" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/4.png" alt="Flower 4" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/9.png" alt="Flower 5" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/6.png" alt="Flower 6" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/17.png" alt="Flower 7" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/26.png" alt="Flower 8" class="object-cover w-full h-48 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/flower pictures(no names)/23.png" alt="Flower 9" class="object-cover w-full h-48 rounded-lg" />
        </div>
      </section>

      <!-- Reviews Section -->
      <section>
        <h2 class="text-center text-2xl font-bold mb-6 bg-[#183655] text-white py-2 rounded">Reviews</h2>
        <div class="grid grid-cols-3 gap-4">
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/1.jfif" alt="Review 1" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/2.jfif" alt="Review 2" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/3.jfif" alt="Review 3" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/4.jfif" alt="Review 4" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/5.jfif" alt="Review 5" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/6.jfif" alt="Review 6" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/7.jfif" alt="Review 7" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/8.jfif" alt="Review 8" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/9.jfif" alt="Review 9" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/10.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/11.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/12.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/13.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/14.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />
          <img src="/K-M-Arts-and-Crafts-Creation/assets/Reviews/15.jfif" alt="Review 10" class="object-contain w-full h-85 rounded-lg" />

        </div>
      </section>
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
