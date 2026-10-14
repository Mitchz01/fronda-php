<?php
/**
 * @var string      $label
 * @var string|null $href
 * @var string|null $icon
 * @var string|null $variant  primary | glass | plain
 * @var string|null $type
 * @var string|null $class
 */
$variant ??= 'primary';
$classList = classes(['btn', "btn--{$variant}", $class ?? '']);
?>
<?php if (isset($href)): ?>
    <a class="<?= e($classList) ?>" href="<?= e($href) ?>">
        <span><?= e($label) ?></span>
        <?php if (isset($icon)): ?><?= icon($icon) ?><?php endif; ?>
    </a>
<?php else: ?>
    <button class="<?= e($classList) ?>" type="<?= e($type ?? 'button') ?>">
        <span class="btn__label"><?= e($label) ?></span>
        <?php if (isset($icon)): ?><?= icon($icon, 'btn__icon') ?><?php endif; ?>
        <span class="btn__spinner" aria-hidden="true"></span>
    </button>
<?php endif; ?>
