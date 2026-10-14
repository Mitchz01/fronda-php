<?php
/**
 * Campo dentro de un grupo de formulario.
 *
 * @var string      $name
 * @var string      $label        texto accesible (se lee pero no se muestra)
 * @var string      $icon
 * @var string      $placeholder
 * @var string|null $type         text | email | tel | textarea
 * @var string|null $value
 * @var string|null $error
 * @var string|null $autocomplete
 * @var int|null    $maxlength
 */
$type ??= 'text';
$id = "campo-{$name}";
$errorId = "{$id}-error";
$hasError = !empty($error);
$attrs = sprintf(
    'id="%s" name="%s" placeholder="%s" required%s%s%s',
    e($id),
    e($name),
    e($placeholder),
    isset($maxlength) ? ' maxlength="' . (int) $maxlength . '"' : '',
    isset($autocomplete) ? ' autocomplete="' . e($autocomplete) . '"' : '',
    $hasError ? ' aria-invalid="true"' : '',
);
?>
<div class="<?= e(classes(['field', 'field--textarea' => $type === 'textarea', 'has-error' => $hasError])) ?>" data-field="<?= e($name) ?>">
    <label class="field__row" for="<?= e($id) ?>">
        <span class="field__icon"><?= icon($icon) ?></span>
        <span class="sr-only"><?= e($label) ?></span>
        <?php if ($type === 'textarea'): ?>
            <textarea <?= $attrs ?> rows="5" aria-describedby="<?= e($errorId) ?>"><?= e($value ?? '') ?></textarea>
        <?php else: ?>
            <input type="<?= e($type) ?>" <?= $attrs ?> value="<?= e($value ?? '') ?>" aria-describedby="<?= e($errorId) ?>">
        <?php endif; ?>
    </label>
    <p class="field__error" id="<?= e($errorId) ?>" data-error-for="<?= e($name) ?>"><?= e($error ?? '') ?></p>
</div>
