<?php

declare(strict_types=1);

use App\Core\View;

/** Escapa texto para imprimirlo seguro en HTML. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Ruta interna respetando la subcarpeta donde viva el sitio. */
function url(string $path = '/'): string
{
    return View::basePath() . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    $file = BASE_PATH . '/public/' . ltrim($path, '/');
    $version = is_file($file) ? filemtime($file) : null;

    return url($path) . ($version ? "?v={$version}" : '');
}

/** @param array<string, mixed> $props */
function component(string $name, array $props = []): string
{
    return View::partial("components/{$name}", $props);
}

function icon(string $name, string $class = ''): string
{
    return component('icon', ['name' => $name, 'class' => $class]);
}

function pexels(int $id, int $width = 1200): string
{
    return "https://images.pexels.com/photos/{$id}/pexels-photo-{$id}.jpeg?auto=compress&cs=tinysrgb&w={$width}";
}

/** @param list<int> $widths */
function pexels_srcset(int $id, array $widths = [480, 800, 1200, 1600]): string
{
    return implode(', ', array_map(static fn (int $w) => pexels($id, $w) . " {$w}w", $widths));
}

function pexels_video(int $id, string $file): string
{
    return "https://videos.pexels.com/video-files/{$id}/{$file}";
}

/** Clases condicionales: classes(['card', 'is-active' => $activo]). */
function classes(array $list): string
{
    $out = [];
    foreach ($list as $key => $value) {
        if (is_int($key) && $value) {
            $out[] = $value;
        } elseif (is_string($key) && $value) {
            $out[] = $key;
        }
    }

    return implode(' ', $out);
}
