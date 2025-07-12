// modal-manage.js

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

document.getElementById("closeModalBtn").addEventListener("click", () => {
  fadeOutModal("manageModal");
});
