// Open modal with dynamic title
document.querySelectorAll(".openManageModal").forEach((button) => {
  button.addEventListener("click", () => {
    const type = button.dataset.type;
    const titleMap = {
      order: "Manage Order",
      delivery: "Schedule Delivery",
      inventory: "Add Inventory Item",
    };
    const title = document.getElementById("manageModalTitle");
    title.textContent = titleMap[type] || "Manage";
    fadeInModal("manageModal");
  });
});

// Close modal on close button
document.getElementById("closeModalBtn").addEventListener("click", () => {
  fadeOutModal("manageModal");
});

// ✅ Close modal when clicking outside the form
const manageModal = document.getElementById("manageModal");

manageModal.addEventListener("click", (event) => {
  const form = manageModal.querySelector("form");

  // If the user clicked outside the form (on the overlay)
  if (!form.contains(event.target)) {
    fadeOutModal("manageModal");
  }
});

function fadeInModal(id) {
  const modal = document.getElementById(id);
  modal.classList.remove("hidden");
  setTimeout(() => {
    modal.querySelector("form").classList.remove("scale-95", "opacity-0");
  }, 10);
}

function fadeOutModal(id) {
  const modal = document.getElementById(id);
  modal.querySelector("form").classList.add("scale-95", "opacity-0");
  setTimeout(() => {
    modal.classList.add("hidden");
  }, 300); // Matches transition duration
}

