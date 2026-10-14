<?php
/**
 * Formulario de contacto. Funciona sin JavaScript (POST /contacto) y
 * contacto.js lo mejora enviándolo a la API sin recargar la página.
 *
 * @var array<string, string> $old
 * @var array<string, string> $errores
 * @var string|null           $errorGeneral
 */
use App\Core\Csrf;

$fields = [
    ['name' => 'nombre', 'label' => 'Nombre del cliente', 'icon' => 'user', 'placeholder' => 'Nombre completo', 'autocomplete' => 'name', 'maxlength' => 120],
    ['name' => 'domicilio', 'label' => 'Domicilio', 'icon' => 'home-09', 'placeholder' => 'Domicilio (calle, número y barrio)', 'autocomplete' => 'street-address', 'maxlength' => 200],
    ['name' => 'telefono', 'label' => 'Teléfono', 'icon' => 'smart-phone-01', 'placeholder' => 'Teléfono', 'type' => 'tel', 'autocomplete' => 'tel', 'maxlength' => 20],
    ['name' => 'correo', 'label' => 'Correo electrónico', 'icon' => 'mail-01', 'placeholder' => 'Correo electrónico', 'type' => 'email', 'autocomplete' => 'email', 'maxlength' => 150],
];
?>
<div class="contact-card" data-contact>
    <form class="form" method="post" action="<?= e(url('/contacto')) ?>" data-contact-form>
        <input type="hidden" name="_token" value="<?= e(Csrf::token()) ?>">

        <div class="form__trap" aria-hidden="true">
            <label for="campo-sitio">No llenar este campo</label>
            <input type="text" id="campo-sitio" name="sitio_web" tabindex="-1" autocomplete="off">
        </div>

        <div class="alert" role="alert" data-form-alert<?= empty($errorGeneral) ? ' hidden' : '' ?>>
            <?= icon('alert-circle') ?>
            <span data-form-alert-text><?= e($errorGeneral ?? '') ?></span>
        </div>

        <div class="group">
            <?php foreach ($fields as $field): ?>
                <?= component('field', [
                    ...$field,
                    'value' => $old[$field['name']] ?? '',
                    'error' => $errores[$field['name']] ?? null,
                ]) ?>
            <?php endforeach; ?>
        </div>

        <div class="group">
            <?= component('field', [
                'name' => 'comentarios',
                'label' => 'Comentarios',
                'icon' => 'message-01',
                'placeholder' => 'Cuéntanos sobre tu espacio: cuánta luz entra, qué plantas te gustan, si tienes mascotas...',
                'type' => 'textarea',
                'maxlength' => 1000,
                'value' => $old['comentarios'] ?? '',
                'error' => $errores['comentarios'] ?? null,
            ]) ?>
        </div>

        <div class="form__footer">
            <p class="form__note"><?= icon('shield-01') ?>Usamos tus datos solo para responderte.</p>
            <?= component('button', ['label' => 'Enviar', 'type' => 'submit', 'icon' => 'sent', 'class' => 'form__submit']) ?>
        </div>
    </form>

    <div class="success" data-contact-success hidden tabindex="-1">
        <span class="success__icon"><?= icon('checkmark-circle-02') ?></span>
        <h3 class="success__title" data-success-title>Mensaje enviado</h3>
        <p class="success__text">Te escribimos en menos de 24 horas para agendar la visita.</p>
        <?= component('button', ['label' => 'Enviar otro mensaje', 'variant' => 'plain', 'class' => 'success__again']) ?>
    </div>
</div>
