<?php
/**
 * @var list<App\Clientes\Cliente> $clientes
 * @var int                        $total
 * @var string|null                $error
 */
?>
<div class="panel container">
    <header class="panel__header">
        <a class="nav__brand" href="<?= e(url('/')) ?>">
            <span class="nav__logo"><?= icon('leaf-01') ?></span>
            <span>Fronda</span>
        </a>
        <a class="btn btn--plain btn--small" href="<?= e(url('/')) ?>">Ver sitio</a>
    </header>

    <div class="panel__title">
        <h1>Mensajes</h1>
        <p><?= $total === 1 ? '1 cliente registrado' : e($total) . ' clientes registrados' ?></p>
    </div>

    <?php if ($error): ?>
        <div class="alert" role="alert"><?= icon('alert-circle') ?><span><?= e($error) ?></span></div>
    <?php elseif ($clientes === []): ?>
        <div class="sheet panel__empty">
            <span class="success__icon success__icon--muted"><?= icon('inbox') ?></span>
            <h2 class="sheet__title">Todavía no hay mensajes</h2>
            <p class="sheet__text">Cuando alguien llene el formulario de contacto aparecerá aquí.</p>
        </div>
    <?php else: ?>
        <div class="panel__grid">
            <?php foreach ($clientes as $cliente): ?>
                <article class="message">
                    <header class="message__header">
                        <span class="message__avatar"><?= e(mb_strtoupper(mb_substr($cliente->nombre, 0, 1))) ?></span>
                        <div>
                            <h2><?= e($cliente->nombre) ?></h2>
                            <time datetime="<?= e($cliente->creadoEn?->format(DATE_ATOM)) ?>"><?= e($cliente->creadoEn?->format('d/m/Y · H:i')) ?></time>
                        </div>
                    </header>
                    <p class="message__body"><?= nl2br(e($cliente->comentarios)) ?></p>
                    <div class="group">
                        <?= component('list-row', ['icon' => 'home-09', 'title' => 'Domicilio', 'text' => $cliente->domicilio]) ?>
                        <?= component('list-row', ['icon' => 'call', 'title' => 'Teléfono', 'text' => $cliente->telefono, 'href' => 'tel:' . preg_replace('/[^\d+]/', '', $cliente->telefono)]) ?>
                        <?= component('list-row', ['icon' => 'mail-01', 'title' => 'Correo', 'text' => $cliente->correo, 'href' => 'mailto:' . $cliente->correo]) ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
