<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Plantillas PHP planas: páginas dentro de un layout y componentes reutilizables.
 */
final class View
{
    private static string $path = '';
    private static string $basePath = '';

    public static function boot(string $path, string $basePath): void
    {
        self::$path = rtrim($path, '/');
        self::$basePath = $basePath;
    }

    public static function basePath(): string
    {
        return self::$basePath;
    }

    /** @param array<string, mixed> $data */
    public static function page(string $page, array $data = [], string $layout = 'layout'): string
    {
        $content = self::partial("pages/{$page}", $data);

        return self::partial($layout, array_merge($data, ['content' => $content]));
    }

    /** @param array<string, mixed> $data */
    public static function partial(string $template, array $data = []): string
    {
        $file = self::$path . "/{$template}.php";

        if (!is_file($file)) {
            throw new RuntimeException("Vista no encontrada: {$template}");
        }

        return (static function (string $__file, array $__data): string {
            extract($__data, EXTR_SKIP);
            ob_start();
            include $__file;

            return (string) ob_get_clean();
        })($file, $data);
    }
}
