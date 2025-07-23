function showWelcomeModal() {
  const modal = document.getElementById("welcomeModal");
  if (modal) {
    modal.style.display = "flex";
    setTimeout(() => {
      modal.querySelector("div").classList.add("animate-fadeIn");
    }, 10);
  }
}

function closeWelcomeModal() {
  const modal = document.getElementById("welcomeModal");
  if (modal) {
    modal.querySelector("div").classList.remove("animate-fadeIn");
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }
}

// Welcome modal event listeners
document.addEventListener("DOMContentLoaded", () => {
  const welcomeModal = document.getElementById("welcomeModal");
  if (welcomeModal) {
    // Close when clicking outside
    welcomeModal.addEventListener("click", (e) => {
      if (e.target === welcomeModal) {
        closeWelcomeModal();
      }
    });
  }
});

welcomeModal.addEventListener("click", (event) => {
  const modalContent = welcomeModal.querySelector("div");

  if (!modalContent.contains(event.target)) {
    closeWelcomeModal();
  }
});
