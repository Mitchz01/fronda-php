/**
 * Los videos solo corren cuando se ven en pantalla. Ahorra datos y batería,
 * y se respetan las preferencias de movimiento reducido.
 */
export function mountVideos(videos) {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    const observer = new IntersectionObserver(
        (entries) => {
            for (const { target, isIntersecting } of entries) {
                if (isIntersecting && !reduceMotion.matches) {
                    target.play().catch(() => {});
                } else {
                    target.pause();
                }
            }
        },
        { threshold: 0.25 },
    );

    videos.forEach((video) => observer.observe(video));
}
