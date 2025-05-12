document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const currentTheme = localStorage.getItem('theme') || 'light';

    if (currentTheme === 'dark') {
        body.classList.add('dark-theme');
        themeToggle.textContent = 'Light Theme';
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-theme');
        const newTheme = body.classList.contains('dark-theme') ? 'dark' : 'light';
        localStorage.setItem('theme', newTheme);
        themeToggle.textContent = newTheme === 'dark' ? 'Light Theme' : 'Dark Theme';
    });
});