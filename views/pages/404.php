<section class="page-center">
    <div class="sheet">
        <span class="success__icon success__icon--muted"><?= icon('plant-04') ?></span>
        <h1 class="sheet__title">Esta página no existe</h1>
        <p class="sheet__text">Puede que el enlace esté mal escrito o que la hayamos movido.</p>
        <?= component('button', ['label' => 'Ir al inicio', 'href' => url('/'), 'icon' => 'arrow-right-02']) ?>
    </div>
</section>
