window.onload = () => {
  fadeInModal("welcomeModal");
};

function closeWelcomeModal() {
  fadeOutModal("welcomeModal");
}

// ✅ Close welcome modal when clicking outside the modal content
const welcomeModal = document.getElementById("welcomeModal");

welcomeModal.addEventListener("click", (event) => {
  const modalContent = welcomeModal.querySelector("div");

  if (!modalContent.contains(event.target)) {
    closeWelcomeModal();
  }
});
