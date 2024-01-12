// greeting.js
document.addEventListener("DOMContentLoaded", function() {
    const greetingMessage = document.getElementById("greetingMessage");

    const currentTime = new Date().getHours();
    let greeting;

    if (currentTime < 12) {
        greeting = "Good morning";
    } else if (currentTime < 18) {
        greeting = "Good afternoon";
    } else {
        greeting = "Good evening";
    }

    greetingMessage.innerText = greeting;
});
