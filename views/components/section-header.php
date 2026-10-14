<?php
/**
 * @var string      $title
 * @var string|null $text
 * @var string|null $id
 */
?>
<header class="section-header">
    <h2 class="section-header__title"<?= isset($id) ? ' id="' . e($id) . '"' : '' ?>><?= e($title) ?></h2>
    <?php if (!empty($text)): ?>
        <p class="section-header__text"><?= e($text) ?></p>
    <?php endif; ?>
</header>
