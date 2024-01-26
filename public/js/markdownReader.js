document.addEventListener('DOMContentLoaded', function () {
    const markdownElements = document.querySelectorAll('.markdown');
    markdownElements.forEach(function (element) {
        const markdownText = element.textContent || element.innerText;
        element.innerHTML = marked(markdownText);
    });
});
