document.addEventListener("DOMContentLoaded", function() {
    const items = document.querySelectorAll('.roadmap-item');
    
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelector('p').classList.add('visible');
            }
        });
    }, {
        threshold: 0.5
    });

    items.forEach(item => {
        observer.observe(item);
    });
});
