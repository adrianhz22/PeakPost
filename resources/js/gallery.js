document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleFormBtn');
    const form = document.getElementById('uploadForm');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');

    if (toggleBtn && form) {
        toggleBtn.addEventListener('click', () => {
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                setTimeout(() => {
                    form.classList.remove('scale-y-0');
                    form.classList.add('scale-y-100');
                }, 10);
            } else {
                form.classList.remove('scale-y-100');
                form.classList.add('scale-y-0');
                setTimeout(() => {
                    form.classList.add('hidden');
                }, 300);
            }
        });
    }

    if (modal && modalImage && closeModal) {
        document.querySelectorAll('.gallery-image').forEach(img => {
            img.addEventListener('click', () => {
                modalImage.src = img.src;
                modal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
            modalImage.src = '';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modalImage.src = '';
            }
        });
    }
});
