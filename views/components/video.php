<?php
/**
 * Video de fondo en silencio. Se reproduce solo cuando está en pantalla (ver videos.js).
 *
 * @var array{id: int, file: string, poster: string, label: string} $video
 * @var string|null $class
 * @var string|null $preload
 */
?>
<video
    class="<?= e(classes(['media', $class ?? ''])) ?>"
    muted
    loop
    playsinline
    preload="<?= e($preload ?? 'none') ?>"
    poster="<?= e($video['poster']) ?>"
    aria-label="<?= e($video['label']) ?>"
    data-autoplay
>
    <source src="<?= e(pexels_video($video['id'], $video['file'])) ?>" type="video/mp4">
</video>
