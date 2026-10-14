<?php

declare(strict_types=1);

/*
 * Contenido editable del sitio. Las vistas solo pintan lo que llega de aquí.
 * Fotos y videos: Pexels (licencia libre).
 */

return [
    'nav' => [
        ['label' => 'Servicios', 'href' => '#servicios'],
        ['label' => 'Proceso', 'href' => '#proceso'],
        ['label' => 'Proyectos', 'href' => '#proyectos'],
        ['label' => 'Contacto', 'href' => '#contacto'],
    ],

    'hero' => [
        'title' => 'Plantas que hacen hogar.',
        'text' => 'Diseñamos, instalamos y cuidamos espacios verdes para casas, apartamentos y oficinas en Santa Marta. Tú disfrutas, nosotros nos encargamos del resto.',
        'stats' => [
            ['value' => '320+', 'label' => 'espacios diseñados'],
            ['value' => '48 h', 'label' => 'para tu primera visita'],
            ['value' => '12 meses', 'label' => 'de garantía por planta'],
        ],
    ],

    'videos' => [
        'hero' => [
            'id' => 8515040,
            'file' => '8515040-hd_1920_1080_24fps.mp4',
            'poster' => 'https://images.pexels.com/videos/8515040/beautiful-botanical-botanist-branch-8515040.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'label' => 'Hojas de monstera moviéndose con la luz',
        ],
        'cuidado' => [
            'id' => 9720741,
            'file' => '9720741-hd_1366_720_25fps.mp4',
            'poster' => 'https://images.pexels.com/videos/9720741/pexels-photo-9720741.jpeg?auto=compress&cs=tinysrgb&w=1200',
            'label' => 'Jardinero revisando plantas en macetas de barro',
            'caption' => 'Visitas de cuidado',
        ],
        'trasplante' => [
            'id' => 6911642,
            'file' => '6911642-hd_720_1280_24fps.mp4',
            'poster' => 'https://images.pexels.com/videos/6911642/pexels-photo-6911642.jpeg?auto=compress&cs=tinysrgb&w=800',
            'label' => 'Manos pasando una planta a una maceta nueva',
            'caption' => 'Trasplantes',
        ],
        'vivero' => [
            'id' => 6509163,
            'file' => '6509163-hd_1280_720_24fps.mp4',
            'poster' => 'https://images.pexels.com/videos/6509163/pexels-photo-6509163.jpeg?auto=compress&cs=tinysrgb&w=800',
            'label' => 'Recorrido por un invernadero con plantas colgantes',
            'caption' => 'Vivero propio',
        ],
    ],

    'services' => [
        [
            'icon' => 'sofa-01',
            'title' => 'Interiores',
            'text' => 'Salas, cocinas y habitaciones con plantas elegidas según la luz real de cada rincón.',
            'image' => 32214290,
            'alt' => 'Monsteras y potos junto a una ventana con luz natural',
        ],
        [
            'icon' => 'building-03',
            'title' => 'Oficinas y locales',
            'text' => 'Ambientes de trabajo más frescos, con diseños que aguantan el aire acondicionado.',
            'image' => 35987814,
            'alt' => 'Local amplio con repisas curvas de madera llenas de plantas',
        ],
        [
            'icon' => 'droplet',
            'title' => 'Cuidado mensual',
            'text' => 'Riego, poda, abono y cambio de maceta para que todo luzca como el primer día.',
            'image' => 4751975,
            'alt' => 'Manos con guantes trasplantando un lirio de paz a una maceta de barro',
        ],
    ],

    'steps' => [
        ['icon' => 'location-01', 'title' => 'Visitamos tu espacio', 'text' => 'Medimos, revisamos la luz y escuchamos lo que buscas.'],
        ['icon' => 'pencil-edit-02', 'title' => 'Diseñamos la propuesta', 'text' => 'Recibes un plan con plantas, materas y un presupuesto claro.'],
        ['icon' => 'plant-02', 'title' => 'Instalamos todo', 'text' => 'Llegamos con lo necesario y dejamos el lugar limpio.'],
        ['icon' => 'calendar-03', 'title' => 'Te acompañamos', 'text' => 'Seguimiento y visitas de cuidado para que nada se marchite.'],
    ],

    'projects' => [
        ['title' => 'Sala con enredaderas', 'place' => 'El Rodadero', 'image' => 3965567, 'alt' => 'Sala luminosa con potos colgando desde el techo'],
        ['title' => 'Rincón de lectura', 'place' => 'Bello Horizonte', 'image' => 31879811, 'alt' => 'Repisa con libros, radio antigua y plantas colgantes'],
        ['title' => 'Estar tropical', 'place' => 'Mamatoco', 'image' => 5825393, 'alt' => 'Planta de hojas largas en maceta roja junto a un sofá'],
        ['title' => 'Entrada de casa colonial', 'place' => 'Centro Histórico', 'image' => 16433504, 'alt' => 'Puerta de madera antigua con una monstera en maceta blanca'],
        ['title' => 'Repisa de cocina', 'place' => 'Pozos Colorados', 'image' => 3190559, 'alt' => 'Repisa blanca con plantas pequeñas y objetos de cocina'],
    ],

    'testimonial' => [
        'quote' => 'Llegaron, midieron la luz de cada ventana y en una semana el apartamento era otro. Seis meses después todas las plantas siguen perfectas.',
        'author' => 'Daniela Ospina',
        'detail' => 'Apartamento en El Rodadero',
        'image' => 4505176,
    ],

    'contact' => [
        'phone' => '+57 300 123 4567',
        'phoneHref' => '+573001234567',
        'email' => 'hola@fronda-estudio.co',
        'address' => 'Calle 22 # 3-45, Santa Marta',
        'hours' => 'Lunes a sábado, 8:00 a 18:00',
        'instagram' => 'https://www.instagram.com/',
        'whatsapp' => 'https://wa.me/573001234567',
        'image' => 4505164,
    ],
];
