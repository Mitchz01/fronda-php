<?php
/** @var array{title: string, place: string, image: int, alt: string} $project */
?>
<article class="project-card">
    <img
        src="<?= e(pexels($project['image'], 800)) ?>"
        srcset="<?= e(pexels_srcset($project['image'], [480, 800, 1200])) ?>"
        sizes="(min-width: 960px) 340px, 78vw"
        alt="<?= e($project['alt']) ?>"
        loading="lazy"
        decoding="async"
    >
    <div class="project-card__caption">
        <h3><?= e($project['title']) ?></h3>
        <p><?= e($project['place']) ?></p>
    </div>
</article>
