
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap");
    
      body {
        font-family: "Roboto Mono", monospace;
      }
    
      .glass-card {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        padding: 1rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
      }
    </style>
  </head>
  <body class="bg-[#d3e1f9] min-h-screen flex">
    <!-- Sidebar -->
    <aside class="bg-white w-[350px] flex flex-col p-6">
      <div class="mb-6">
        <img
          src="/K-M-Arts-and-Crafts-Creation/assets/Logo.png"
          alt="Logo K and M Arts and Crafts"
          class="w-[300px] h-[100px] object-contain"
        />
      </div>
      <div class="flex items-center space-x-4 mb-4">
        <img
          src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
          alt="User profile"
          class="w-20 h-20 rounded-full"
        />
        
        <div class="text-lg font-bold leading-tight">
          <p id="sidebar-first-name" class="text-[#0f2e4d]">Loading...</p>
          <p id="sidebar-last-name" class="text-[#0f2e4d]">Loading...</p>
          <div class="flex items-center space-x-1 text-xs font-normal">
            <span class="w-3 h-3 rounded-full bg-lime-500 inline-block"></span>
            <span class="text-[#0f2e4d]">Status: <span class="font-normal">Online</span></span>
          </div>
        </div>
      </div>
      <hr class="border-gray-500 mb-6" />
      <nav
        class="flex flex-col space-y-3 text-lg font-bold text-[#0f2e4d] tracking-wide"
      >
        <div class="pl-1 py-1 px-2 rounded text-[#0f2e4d]">Menu</div>
        <a
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Dashboard.php"
          >Dashboard</a
        >
        <a
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Order.php"
          >Orders</a
        >
        <a
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Delivery.php"
          >Deliveries</a
        >
        <a
          class="pl-4 py-1 px-2 rounded hover:bg-blue-100 transition duration-150"
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Inventory.php"
          >Inventory</a
        >
        <a
          class="pl-4 py-1 px-2 rounded bg-blue-100"
          href="/K-M-Arts-and-Crafts-Creation/frontend/admin/Profile.php"
          >Profile</a
        >
        <a
          id="logout-btn"
          class="pl-4 py-1 px-2 rounded hover:bg-red-100 transition duration-150"
          href="#"
          >Logout</a
        >
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6 text-[#1a1a1a]">
      <header class="mb-6">
        <button aria-label="Menu" class="text-[#1a1a1a] text-xl">
          <i class="fas fa-bars"></i>
        </button>
      </header>

      <section>
        <h2
          class="font-bold text-base tracking-widest mb-2 border-b border-[#1a1a1a] pb-1"
        >
          My Profile
        </h2>

        <div class="space-y-4">
          <!-- User Summary Card -->
          <div class="bg-white rounded-xl p-4 shadow-md flex items-center space-x-6">
            <img
              src="/K-M-Arts-and-Crafts-Creation/assets/pfp.jpg"
              alt="User"
              class="w-16 h-16 rounded-full"
            />
            <div>
              <p id="summary-username" class="font-bold text-lg tracking-wide">
                Loading...
              </p>
              <p class="text-xs font-normal">Admin</p>
              <p id="summary-address" class="text-xs font-normal">
                Philippines, Cebu 6000
              </p>
            </div>
          </div>

          <!-- Personal Info Section -->
          <div id="personal-info" class="bg-white rounded-xl p-4 shadow-md grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
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
              <p id="first-name-text" class="font-bold text-sm">Loading...</p>
              <input
                id="first-name-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Last Name</p>
              <p id="last-name-text" class="font-bold text-sm">Loading...</p>
              <input
                id="last-name-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Date Of Birth</p>
              <p id="dob-text" class="font-bold text-sm">Loading...</p>
              <input
                id="dob-input"
                type="date"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Phone</p>
              <p id="phone-text" class="font-bold text-sm">Loading...</p>
              <input
                id="phone-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Email Address</p>
              <p id="email-text" class="font-bold text-sm underline">Loading...</p>
              <input
                id="email-input"
                type="email"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">User Role</p>
              <p id="user-role-text" class="font-bold text-sm">Admin</p>
            </div>
          </div>

          <!-- Address Section -->
          <div id="address-info" class="bg-white rounded-xl p-4 shadow-md grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
            <div class="col-span-full flex justify-between items-center mb-2">
              <p class="font-bold text-sm tracking-widest border-b border-[#0f2e4d] pb-1">
                Address Information
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
            <div class="col-span-full">
              <p class="text-xs font-semibold tracking-widest">Street Address</p>
              <p id="address-text" class="font-bold text-sm">Loading...</p>
              <input
                id="address-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                placeholder="Enter your street address"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Country</p>
              <p id="country-text" class="font-bold text-sm">Loading...</p>
              <input
                id="country-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">City</p>
              <p id="city-text" class="font-bold text-sm">Loading...</p>
              <input
                id="city-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
            <div>
              <p class="text-xs font-semibold tracking-widest">Postal Code</p>
              <p id="postal-code-text" class="font-bold text-sm">Loading...</p>
              <input
                id="postal-code-input"
                type="text"
                class="hidden font-bold text-sm rounded-md p-1 w-full"
                value=""
              />
            </div>
          </div>

        </div>
      </section>
    </main>

    <script>
      // Global variables to store original values
      let originalPersonalData = {};
      let originalAddressData = {};

      function toggleEdit(sectionId, enable) {
        const section = document.getElementById(sectionId);
        const textFields = section.querySelectorAll('[id$="-text"]');
        const inputFields = section.querySelectorAll('[id$="-input"]');
        const editBtn = document.getElementById(`edit-${sectionId}`);
        const saveBtn = document.getElementById(`save-${sectionId}`);
        const cancelBtn = document.getElementById(`cancel-${sectionId}`);

        if (enable) {
          // Store original values before editing
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
          // Restore original values
          document.getElementById('first-name-text').textContent = originalPersonalData.firstName;
          document.getElementById('last-name-text').textContent = originalPersonalData.lastName;
          document.getElementById('email-text').textContent = originalPersonalData.email;
          document.getElementById('phone-text').textContent = originalPersonalData.phone;
          document.getElementById('dob-text').textContent = originalPersonalData.dob;
          
          // Reset input values
          document.getElementById('first-name-input').value = originalPersonalData.firstName;
          document.getElementById('last-name-input').value = originalPersonalData.lastName;
          document.getElementById('email-input').value = originalPersonalData.email;
          document.getElementById('phone-input').value = originalPersonalData.phone;
          
          // Convert date format back for input
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
          // Update text fields with input values
          const firstName = document.getElementById('first-name-input').value;
          const lastName = document.getElementById('last-name-input').value;
          const email = document.getElementById('email-input').value;
          const phone = document.getElementById('phone-input').value;
          const dobInput = document.getElementById('dob-input').value;
          
          // Format date for display
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
          
          // Update sidebar and summary
          document.getElementById('sidebar-first-name').textContent = firstName;
          document.getElementById('sidebar-last-name').textContent = lastName;
          document.getElementById('summary-username').textContent = `${firstName} ${lastName}`;
          
          // Send to backend
          sendUserDataToBackend();
        } else if (sectionId === 'address-info') {
          const address = document.getElementById('address-input').value;
          const country = document.getElementById('country-input').value;
          const city = document.getElementById('city-input').value;
          const postalCode = document.getElementById('postal-code-input').value;
          
          document.getElementById('address-text').textContent = address || 'Not provided';
          document.getElementById('country-text').textContent = country;
          document.getElementById('city-text').textContent = city;
          document.getElementById('postal-code-text').textContent = postalCode;
          
          // Update summary address
          document.getElementById('summary-address').textContent = `${country}, ${city} ${postalCode}`;
          
          // Send to backend
          sendAddressDataToBackend();
        }

        toggleEdit(sectionId, false);
      }

      function sendUserDataToBackend() {
        const user_id = localStorage.getItem("user_id");
        
        if (!user_id) {
          alert("User ID not found. Please log in again.");
          return;
        }

        const data = {
          update_type: "personal_info",
          user_id: user_id,
          first_name: document.getElementById("first-name-input").value,
          last_name: document.getElementById("last-name-input").value,
          email: document.getElementById("email-input").value,
          contact_number: document.getElementById("phone-input").value,
          dateofbirth: document.getElementById("dob-input").value,
        };

        fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/update_user_info.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        })
        .then((res) => res.json())
        .then((response) => {
          if (response.success) {
            console.log("Personal information updated successfully");
          } else {
            alert("Update failed: " + response.message);
          }
        })
        .catch((err) => {
          console.error("Error:", err);
          alert("Something went wrong while updating personal info.");
        });
      }

      function sendAddressDataToBackend() {
        const user_id = localStorage.getItem("user_id");
        
        if (!user_id) {
          alert("User ID not found. Please log in again.");
          return;
        }

        const data = {
          update_type: "address_info",
          user_id: user_id,
          address: document.getElementById("address-input").value,
          country: document.getElementById("country-input").value,
          city: document.getElementById("city-input").value,
          postal_code: document.getElementById("postal-code-input").value,
        };

        fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/update_user_info.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        })
        .then((res) => res.json())
        .then((response) => {
          if (response.success) {
            console.log("Address information updated successfully");
          } else {
            alert("Address update failed: " + response.message);
          }
        })
        .catch((err) => {
          console.error("Error:", err);
          alert("Something went wrong while updating address info.");
        });
      }

      // Event listeners
      document.getElementById("edit-personal-info").addEventListener("click", () => toggleEdit("personal-info", true));
      document.getElementById("save-personal-info").addEventListener("click", () => saveChanges("personal-info"));
      document.getElementById("cancel-personal-info").addEventListener("click", () => cancelChanges("personal-info"));

      document.getElementById("edit-address-info").addEventListener("click", () => toggleEdit("address-info", true));
      document.getElementById("save-address-info").addEventListener("click", () => saveChanges("address-info"));
      document.getElementById("cancel-address-info").addEventListener("click", () => cancelChanges("address-info"));

      // Logout functionality
      document.getElementById("logout-btn").addEventListener("click", function (e) {
        e.preventDefault();

        fetch("http://localhost/K-M-Arts-and-Crafts-Creation/backend/auth/logout.php", {
          method: "POST",
          credentials: "include"
        })
        .then(res => res.text())
        .then(response => {
          localStorage.removeItem("isLoggedIn");
          localStorage.removeItem("user_id");
          localStorage.removeItem("user_type");
          localStorage.removeItem("username");
          window.location.href = "/K-M-Arts-and-Crafts-Creation/index.php";
        })
        .catch(err => {
          console.error("Logout failed:", err);
          alert("Something went wrong during logout.");
        });
      });

      // Load user data on page load
      window.addEventListener("DOMContentLoaded", function () {
        const userId = localStorage.getItem("user_id");

        if (!userId) {
          alert("Please log in to view your profile.");
          window.location.href = "/K-M-Arts-and-Crafts-Creation/index.php";
          return;
        }

        fetch(`http://localhost/K-M-Arts-and-Crafts-Creation/backend/users/get_user_info.php?user_id=${userId}`)
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              // Format date for display
              let dobDisplay = data.dateofbirth;
              if (data.dateofbirth) {
                const date = new Date(data.dateofbirth);
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                const year = date.getFullYear();
                dobDisplay = `${month} - ${day} - ${year}`;
              }
              
              // Fill display fields
              document.getElementById("first-name-text").textContent = data.first_name || '';
              document.getElementById("last-name-text").textContent = data.last_name || '';
              document.getElementById("email-text").textContent = data.email || '';
              document.getElementById("dob-text").textContent = dobDisplay || '';
              document.getElementById("phone-text").textContent = data.contact_number || '';
              
              // Fill address fields
              document.getElementById("address-text").textContent = data.address || 'Not provided';
              document.getElementById("country-text").textContent = data.country || 'Philippines';
              document.getElementById("city-text").textContent = data.city || 'Cebu';
              document.getElementById("postal-code-text").textContent = data.postal_code || '6000';

              // Fill input fields
              document.getElementById("first-name-input").value = data.first_name || '';
              document.getElementById("last-name-input").value = data.last_name || '';
              document.getElementById("email-input").value = data.email || '';
              document.getElementById("dob-input").value = data.dateofbirth || '';
              document.getElementById("phone-input").value = data.contact_number || '';
              
              // Fill address input fields
              document.getElementById("address-input").value = data.address || '';
              document.getElementById("country-input").value = data.country || 'Philippines';
              document.getElementById("city-input").value = data.city || 'Cebu';
              document.getElementById("postal-code-input").value = data.postal_code || '6000';

              // Update sidebar and summary
              document.getElementById("sidebar-first-name").textContent = data.first_name || '';
              document.getElementById("sidebar-last-name").textContent = data.last_name || '';
              document.getElementById("summary-username").textContent = `${data.first_name || ''} ${data.last_name || ''}`;
              document.getElementById("summary-address").textContent = `${data.country || 'Philippines'}, ${data.city || 'Cebu'} ${data.postal_code || '6000'}`;
            } else {
              alert("Failed to load user data: " + data.message);
            }
          })
          .catch((error) => {
            console.error("Error loading user data:", error);
            alert("Error loading user data. Please try again.");
          });
      });
    </script>
  </body>
</html>