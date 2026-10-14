<?php
/**
 * @var array                 $site
 * @var array<string, string> $old
 * @var array<string, string> $errores
 * @var string|null           $errorGeneral
 */
$hero = $site['hero'];
$videos = $site['videos'];
$contact = $site['contact'];
$testimonial = $site['testimonial'];
?>

<section class="hero" aria-labelledby="hero-title">
    <?= component('video', ['video' => $videos['hero'], 'class' => 'hero__video', 'preload' => 'auto']) ?>
    <div class="hero__shade" aria-hidden="true"></div>

    <div class="hero__inner">
        <div class="hero__content">
            <h1 class="hero__title" id="hero-title"><?= e($hero['title']) ?></h1>
            <p class="hero__text"><?= e($hero['text']) ?></p>
            <div class="hero__actions">
                <?= component('button', ['label' => 'Agenda una visita', 'href' => '#contacto', 'icon' => 'arrow-right-02']) ?>
                <?= component('button', ['label' => 'Ver proyectos', 'href' => '#proyectos', 'variant' => 'glass']) ?>
            </div>
        </div>

        <dl class="hero__stats glass">
            <?php foreach ($hero['stats'] as $stat): ?>
                <div class="stat">
                    <dt><?= e($stat['label']) ?></dt>
                    <dd><?= e($stat['value']) ?></dd>
                </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>

<section class="section" id="servicios" aria-labelledby="servicios-title">
    <div class="container">
        <?= component('section-header', [
            'id' => 'servicios-title',
            'title' => 'Verde a la medida de tu espacio',
            'text' => 'Estudiamos la luz, la humedad y tu rutina para elegir plantas que de verdad prosperen.',
        ]) ?>

        <div class="services-grid">
            <?php foreach ($site['services'] as $service): ?>
                <?= component('service-card', ['service' => $service]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section--tinted" id="proceso" aria-labelledby="proceso-title">
    <div class="container process">
        <div class="process__intro">
            <?= component('section-header', [
                'id' => 'proceso-title',
                'title' => 'Así trabajamos',
                'text' => 'Cuatro pasos sencillos, sin que tengas que mover una sola matera.',
            ]) ?>

            <div class="group">
                <?php foreach ($site['steps'] as $step): ?>
                    <?= component('list-row', $step) ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bento">
            <?php foreach (['cuidado' => 'bento__item--wide', 'trasplante' => 'bento__item--tall', 'vivero' => ''] as $key => $modifier): ?>
                <figure class="<?= e(classes(['bento__item', $modifier])) ?>">
                    <?= component('video', ['video' => $videos[$key]]) ?>
                    <figcaption class="glass glass--chip"><?= e($videos[$key]['caption']) ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="proyectos" aria-labelledby="proyectos-title">
    <div class="container">
        <div class="section-header-row">
            <?= component('section-header', [
                'id' => 'proyectos-title',
                'title' => 'Espacios que ya respiran',
                'text' => 'Algunos de los lugares que llenamos de vida este año.',
            ]) ?>
            <div class="carousel-controls">
                <button class="icon-btn" type="button" aria-label="Proyecto anterior" data-carousel-prev><?= icon('arrow-left-01') ?></button>
                <button class="icon-btn" type="button" aria-label="Proyecto siguiente" data-carousel-next><?= icon('arrow-right-01') ?></button>
            </div>
        </div>
    </div>

    <div class="carousel" data-carousel tabindex="0" aria-label="Proyectos">
        <?php foreach ($site['projects'] as $project): ?>
            <?= component('project-card', ['project' => $project]) ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="section section--tight" aria-label="Opinión de una clienta">
    <div class="container">
        <figure class="testimonial">
            <img
                class="testimonial__photo"
                src="<?= e(pexels($testimonial['image'], 1000)) ?>"
                srcset="<?= e(pexels_srcset($testimonial['image'], [600, 1000, 1400])) ?>"
                sizes="(min-width: 960px) 480px, 100vw"
                alt="Clienta trasplantando una lengua de suegra en su sala"
                loading="lazy"
                decoding="async"
            >
            <div class="testimonial__body">
                <?= icon('quote-down', 'testimonial__mark') ?>
                <blockquote>
                    <p><?= e($testimonial['quote']) ?></p>
                </blockquote>
                <figcaption>
                    <strong><?= e($testimonial['author']) ?></strong>
                    <span><?= e($testimonial['detail']) ?></span>
                </figcaption>
            </div>
        </figure>
    </div>
</section>

<section class="section section--tinted" id="contacto" aria-labelledby="contacto-title">
    <div class="container contact">
        <div class="contact__aside">
            <?= component('section-header', [
                'id' => 'contacto-title',
                'title' => 'Hablemos de tu espacio',
                'text' => 'Cuéntanos qué tienes en mente y agendamos una visita sin costo.',
            ]) ?>

            <img
                class="contact__photo"
                src="<?= e(pexels($contact['image'], 1000)) ?>"
                srcset="<?= e(pexels_srcset($contact['image'], [600, 1000])) ?>"
                sizes="(min-width: 960px) 440px, 100vw"
                alt="Manos sembrando una lengua de suegra en una maceta de barro"
                loading="lazy"
                decoding="async"
            >

            <div class="group">
                <?= component('list-row', ['icon' => 'call', 'title' => 'Teléfono', 'text' => $contact['phone'], 'href' => 'tel:' . $contact['phoneHref']]) ?>
                <?= component('list-row', ['icon' => 'mail-01', 'title' => 'Correo', 'text' => $contact['email'], 'href' => 'mailto:' . $contact['email']]) ?>
                <?= component('list-row', ['icon' => 'location-01', 'title' => 'Estudio', 'text' => $contact['address']]) ?>
                <?= component('list-row', ['icon' => 'clock-01', 'title' => 'Horario', 'text' => $contact['hours']]) ?>
            </div>
        </div>

        <div class="contact__panel">
            <?= component('contact-form', [
                'old' => $old,
                'errores' => $errores,
                'errorGeneral' => $errorGeneral,
            ]) ?>
        </div>
    </div>
</section>
