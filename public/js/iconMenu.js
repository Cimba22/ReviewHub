document.addEventListener('DOMContentLoaded', function () {
    const navBar = document.querySelector("nav"),
        avatarIcons = document.querySelectorAll(".avatar__circle"),
        overlay = document.querySelector(".overlay");

    avatarIcons.forEach(avatarIcon => {
        avatarIcon.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
});


