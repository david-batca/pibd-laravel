document.addEventListener("DOMContentLoaded", () => {
    const alert = document.getElementById("flash-alert");
    if (!alert) return;
    setTimeout(() => {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500);
    }, 3000);
});
