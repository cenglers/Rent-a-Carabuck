// Sayfa yüklendiğinde çalışacak genel işlevler
document.addEventListener("DOMContentLoaded", function () {
    // Hoş geldin mesajı
    const welcomeMessage = document.querySelector("#welcomeMessage");
    if (welcomeMessage) {
        const userName = localStorage.getItem("userName") || "Guest";
        welcomeMessage.textContent = `Welcome, ${userName}!`;
    }

    // Tema değiştirme örneği
    const themeToggle = document.querySelector("#themeToggle");
    if (themeToggle) {
        themeToggle.addEventListener("click", function () {
            document.body.classList.toggle("dark-theme");
            const theme = document.body.classList.contains("dark-theme") ? "dark" : "light";
            localStorage.setItem("theme", theme);
        });

        // Daha önce seçilmiş tema varsa uygula
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-theme");
        }
    }
});
