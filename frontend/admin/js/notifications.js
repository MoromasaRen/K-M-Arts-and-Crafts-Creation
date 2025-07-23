// Function to format the timestamp
function formatTimestamp(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);

    if (diffInSeconds < 60) {
        return 'Just now';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    } else {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    }
}

// Function to create a notification element
function createNotificationElement(notification) {
    const li = document.createElement('li');
    li.className = 'bg-blue-50 p-3 rounded shadow-sm hover:bg-blue-100 transition-colors duration-200';
    
    const mainText = document.createElement('p');
    mainText.className = 'text-gray-800 font-medium';
    mainText.innerHTML = `#${notification.id} - ${notification.user_name}`;
    
    const detailsText = document.createElement('p');
    detailsText.className = 'text-gray-600 text-sm mt-1';
    detailsText.textContent = `${notification.details}${notification.quantity > 1 ? ` x${notification.quantity}` : ''}`;
    
    const timeText = document.createElement('p');
    timeText.className = 'text-gray-500 text-xs mt-1';
    timeText.textContent = formatTimestamp(notification.timestamp);
    
    li.appendChild(mainText);
    li.appendChild(detailsText);
    li.appendChild(timeText);
    
    return li;
}

// Function to fetch and update notifications
async function fetchNotifications() {
    try {
        const response = await fetch('/K-M-Arts-and-Crafts-Creation/backend/dashboard/get_notifications.php');
        const data = await response.json();
        
        if (data.success) {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = ''; // Clear existing notifications
            
            data.notifications.forEach(notification => {
                const notificationElement = createNotificationElement(notification);
                notificationList.appendChild(notificationElement);
            });
        } else {
            console.error('Failed to fetch notifications:', data.error);
        }
    } catch (error) {
        console.error('Error fetching notifications:', error);
    }
}

// Fetch notifications immediately when the page loads
document.addEventListener('DOMContentLoaded', () => {
    fetchNotifications();
});

// Update notifications every 30 seconds
setInterval(fetchNotifications, 30000);