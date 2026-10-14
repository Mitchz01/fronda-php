<?php
/**
 * Fila estilo lista agrupada de iOS: ícono, título y detalle.
 *
 * @var string      $icon
 * @var string      $title
 * @var string      $text
 * @var string|null $href
 */
$tag = isset($href) ? 'a' : 'div';
?>
<<?= $tag ?> class="list-row"<?= isset($href) ? ' href="' . e($href) . '"' : '' ?>>
    <span class="tile"><?= icon($icon) ?></span>
    <span class="list-row__content">
        <span class="list-row__title"><?= e($title) ?></span>
        <span class="list-row__text"><?= e($text) ?></span>
    </span>
    <?php if (isset($href)): ?><?= icon('arrow-right-01', 'list-row__chevron') ?><?php endif; ?>
</<?= $tag ?>>
