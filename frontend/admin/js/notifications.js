function fetchNotifications() {
    const list = document.getElementById("notificationList");
  
    // Simulated new notification
    const newNotification = document.createElement("li");
    newNotification.className = "bg-blue-50 p-3 rounded shadow-sm";
    newNotification.innerHTML = `
      <p class="text-gray-800">
        🛒 <strong>Order #${Math.floor(Math.random() * 90000 + 10000)}</strong> placed by <strong>User_${Math.floor(Math.random() * 100)}</strong>
      </p>
      <p class="text-gray-500 text-xs">Just now</p>
    `;
  
    // Add to top of list
    list.prepend(newNotification);
  
    // Optional: limit to 10 recent
    while (list.children.length > 10) {
      list.removeChild(list.lastChild);
    }
  }
  
  // Optional: auto-fetch new notifications every 15s
  // setInterval(fetchNotifications, 15000);