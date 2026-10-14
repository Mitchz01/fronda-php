<?php
/** @var list<array{label: string, href: string}> $links */
?>
<header class="nav" data-nav>
    <div class="nav__bar">
        <a class="nav__brand" href="<?= e(url('/')) ?>" aria-label="Fronda, inicio">
            <span class="nav__logo"><?= icon('leaf-01') ?></span>
            <span>Fronda</span>
        </a>

        <nav class="nav__links" id="nav-links" aria-label="Principal">
            <?php foreach ($links as $link): ?>
                <a href="<?= e($link['href']) ?>"><?= e($link['label']) ?></a>
            <?php endforeach; ?>
        </nav>

        <a class="btn btn--primary btn--small nav__cta" href="<?= e(url('/#contacto')) ?>">Agenda una visita</a>

        <button class="nav__toggle" type="button" aria-controls="nav-links" aria-expanded="false" aria-label="Abrir menú" data-nav-toggle>
            <?= icon('menu-02', 'nav__toggle-open') ?>
            <?= icon('cancel-01', 'nav__toggle-close') ?>
        </button>
    </div>
</header>
