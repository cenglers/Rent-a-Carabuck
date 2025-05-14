document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.querySelector("#registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            const password = document.querySelector("#password").value;
            const confirmPassword = document.querySelector("#confirmPassword").value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
    }
});
