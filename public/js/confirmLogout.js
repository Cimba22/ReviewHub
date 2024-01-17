

function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
        // Перенаправление на страницу выхода
        window.location.href = "/security/logout";
    } else {
        // Отмена выхода
        return false;
    }
}
