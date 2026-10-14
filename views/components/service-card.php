<?php
/** @var array{icon: string, title: string, text: string, image: int, alt: string} $service */
?>
<article class="service-card">
    <div class="service-card__media">
        <img
            src="<?= e(pexels($service['image'], 800)) ?>"
            srcset="<?= e(pexels_srcset($service['image'], [480, 800, 1200])) ?>"
            sizes="(min-width: 960px) 360px, 100vw"
            alt="<?= e($service['alt']) ?>"
            loading="lazy"
            decoding="async"
        >
    </div>
    <div class="service-card__body">
        <div class="service-card__heading">
            <span class="tile"><?= icon($service['icon']) ?></span>
            <h3><?= e($service['title']) ?></h3>
        </div>
        <p><?= e($service['text']) ?></p>
    </div>
</article>
