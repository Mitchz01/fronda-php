<?php
/**
 * @var string      $content
 * @var string      $title
 * @var string|null $description
 * @var array       $site
 * @var bool|null   $bare  oculta navegación y pie (panel, páginas simples)
 */
use App\Core\Csrf;

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($description ?? 'Diseñamos, instalamos y cuidamos espacios verdes en Santa Marta.') ?>">
    <meta name="theme-color" content="#f2f2f7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#000000" media="(prefers-color-scheme: dark)">
    <meta name="base-url" content="<?= e(url('/')) ?>">
    <meta name="csrf-token" content="<?= e(Csrf::token()) ?>">

    <link rel="icon" href="<?= e(asset('assets/img/favicon.svg')) ?>" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.pexels.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css">
    <link rel="stylesheet" href="<?= e(asset('assets/css/app.css')) ?>">

    <script type="module" src="<?= e(asset('assets/js/main.js')) ?>"></script>
</head>
<body>
    <?php if (empty($bare)): ?>
        <?= component('nav', ['links' => $site['nav']]) ?>
    <?php endif; ?>

    <main id="contenido">
        <?= $content ?>
    </main>

    <?php if (empty($bare)): ?>
        <?= component('footer', ['contact' => $site['contact']]) ?>
    <?php endif; ?>
</body>
</html>
