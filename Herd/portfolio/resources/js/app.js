import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const getStoredTheme = () => {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        return savedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
};

const applyTheme = (theme = getStoredTheme()) => {
    document.documentElement.classList.toggle('dark', theme === 'dark');
};

applyTheme();

document.addEventListener('click', (event) => {
    if (! event.target.closest('[data-theme-toggle]')) {
        return;
    }

    const nextTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';

    localStorage.setItem('theme', nextTheme);
    applyTheme(nextTheme);
});

document.addEventListener('livewire:navigating', (event) => {
    event.detail.onSwap(() => applyTheme());
});

document.addEventListener('livewire:navigated', () => {
    applyTheme();
    window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
});
