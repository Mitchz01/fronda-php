<?php

declare(strict_types=1);

use App\Core\Env;

return [
    'name' => 'Fronda',
    'env' => Env::get('APP_ENV', 'production'),
    'debug' => Env::bool('APP_DEBUG'),
    'timezone' => 'America/Bogota',

    'panel' => [
        'user' => Env::get('PANEL_USER', 'admin'),
        'password' => Env::get('PANEL_PASSWORD', 'fronda'),
    ],
];
