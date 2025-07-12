// modal-info.js

function openModal(type) {
  const title = document.getElementById("modalTitle");
  const content = document.getElementById("modalContent");
  const link = document.getElementById("modalLink");

  switch (type) {
    case "orders":
      title.innerText = "Orders Info";
      content.innerText = "More details about current orders.";
      link.href = "/frontend/admin/Order.html";
      break;
    case "deliveries":
      title.innerText = "Deliveries Info";
      content.innerText = "More details about current deliveries.";
      link.href = "/frontend/admin/Delivery.html";
      break;
    case "inventory":
      title.innerText = "Inventory Info";
      content.innerText = "More details about inventory status.";
      link.href = "/frontend/admin/Inventory.html";
      break;
  }

  fadeInModal("infoModal");
}

function closeModal() {
  fadeOutModal("infoModal");
}
