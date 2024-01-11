document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");

    form.addEventListener("submit", function(event) {
        const password = form.querySelector("#password").value;
        const confirm_password = form.querySelector("#confirm_password").value;

        if (password !== confirm_password) {
            alert("Passwords do not match");
            event.preventDefault(); // Отменяет отправку формы, если пароли не совпадают
        }
    });
});
