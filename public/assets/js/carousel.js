export function mountCarousel(track, prev, next) {
    const step = () => {
        const card = track.firstElementChild;
        const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
        return card ? card.getBoundingClientRect().width + gap : track.clientWidth;
    };

    const update = () => {
        const max = track.scrollWidth - track.clientWidth - 2;
        prev.disabled = track.scrollLeft <= 2;
        next.disabled = track.scrollLeft >= max;
    };

    prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
    next.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);

    update();
}
