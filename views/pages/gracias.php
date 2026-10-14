<?php
/** @var string $nombre */
?>
<section class="page-center">
    <div class="sheet">
        <span class="success__icon"><?= icon('checkmark-circle-02') ?></span>
        <h1 class="sheet__title">Gracias, <?= e($nombre) ?></h1>
        <p class="sheet__text">Recibimos tu mensaje. Te escribimos en menos de 24 horas para agendar la visita.</p>
        <?= component('button', ['label' => 'Volver al inicio', 'href' => url('/'), 'icon' => 'arrow-right-02']) ?>
    </div>
</section>
