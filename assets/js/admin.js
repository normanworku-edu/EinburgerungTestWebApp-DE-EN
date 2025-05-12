document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            const imageInput = document.getElementById('image');
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                if (!file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                    e.preventDefault();
                    alert('Please upload an image file smaller than 2MB.');
                }
            }
        });
    }

    const skeletonLoaders = document.querySelectorAll('.skeleton-loader');
    if (skeletonLoaders.length) {
        setTimeout(() => {
            skeletonLoaders.forEach(loader => loader.classList.remove('skeleton-loader'));
        }, 1000);
    }
});