<?php
/** @var array{phone: string, phoneHref: string, email: string, address: string, instagram: string, whatsapp: string} $contact */
?>
<footer class="footer">
    <div class="container footer__inner">
        <div class="footer__brand">
            <a class="nav__brand" href="<?= e(url('/')) ?>">
                <span class="nav__logo"><?= icon('leaf-01') ?></span>
                <span>Fronda</span>
            </a>
            <p>Estudio de plantas para interiores y jardines en Santa Marta.</p>
        </div>

        <div class="footer__links">
            <a href="tel:<?= e($contact['phoneHref']) ?>"><?= icon('call') ?><?= e($contact['phone']) ?></a>
            <a href="mailto:<?= e($contact['email']) ?>"><?= icon('mail-01') ?><?= e($contact['email']) ?></a>
            <span><?= icon('location-01') ?><?= e($contact['address']) ?></span>
        </div>

        <div class="footer__social">
            <a href="<?= e($contact['instagram']) ?>" aria-label="Instagram" target="_blank" rel="noopener"><?= icon('instagram') ?></a>
            <a href="<?= e($contact['whatsapp']) ?>" aria-label="WhatsApp" target="_blank" rel="noopener"><?= icon('whatsapp') ?></a>
        </div>
    </div>

    <div class="container footer__legal">
        <p>&copy; <?= date('Y') ?> Fronda. Empresa ficticia creada como proyecto académico.</p>
        <p>Fotos y videos de <a href="https://www.pexels.com" target="_blank" rel="noopener">Pexels</a>.</p>
    </div>
</footer>
