// =========================
// DARK / LIGHT MODE
// =========================

// Load saved theme
window.onload = function () {
  const savedTheme = localStorage.getItem("theme");

  if (savedTheme === "dark") {
    document.body.classList.add("dark-mode");
    updateButtonText(true);
  } else {
    updateButtonText(false);
  }
};

// Toggle theme
function toggleTheme() {
  document.body.classList.toggle("dark-mode");

  const isDark = document.body.classList.contains("dark-mode");

  if (isDark) {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }

  updateButtonText(isDark);
}

// Update button label
function updateButtonText(isDark) {
  const btn = document.getElementById("themeBtn");

  if (!btn) return;

  btn.innerText = isDark ? "☀ Light" : "🌙 Dark";
}
