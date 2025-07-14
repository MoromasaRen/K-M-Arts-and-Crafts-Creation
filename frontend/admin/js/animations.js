// animations.js

// Generic function to animate any element
function animateElement(element, animationClass, duration = 500) {
  element.classList.add(animationClass);

  setTimeout(() => {
    element.classList.remove(animationClass);
  }, duration);
}

// Fade in modal
function fadeInModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    const innerDiv = modal.querySelector("div");
    if (innerDiv) animateElement(innerDiv, "animate-fadeIn");
  }
}

// Fade out modal
function fadeOutModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("flex");
    modal.classList.add("hidden");
  }
}
