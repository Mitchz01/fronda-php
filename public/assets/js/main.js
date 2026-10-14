import { mountCarousel } from './carousel.js';
import { mountContactForm } from './contacto.js';
import { mountNav } from './nav.js';
import { mountVideos } from './videos.js';

const nav = document.querySelector('[data-nav]');
if (nav) mountNav(nav);

const videos = document.querySelectorAll('video[data-autoplay]');
if (videos.length) mountVideos(videos);

const carousel = document.querySelector('[data-carousel]');
if (carousel) {
    mountCarousel(
        carousel,
        document.querySelector('[data-carousel-prev]'),
        document.querySelector('[data-carousel-next]'),
    );
}

const contact = document.querySelector('[data-contact]');
if (contact) mountContactForm(contact);
