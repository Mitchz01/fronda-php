<?php

declare(strict_types=1);

namespace App\Core;

final class Csrf
{
    private const KEY = '_csrf';

    public static function token(): string
    {
        $token = Session::get(self::KEY);

        if (!is_string($token)) {
            $token = bin2hex(random_bytes(32));
            Session::put(self::KEY, $token);
        }

        return $token;
    }

    public static function valid(?string $token): bool
    {
        $expected = Session::get(self::KEY);

        return is_string($expected) && is_string($token) && hash_equals($expected, $token);
    }

    public static function fromRequest(Request $request): ?string
    {
        $token = $request->header('X-CSRF-Token') ?? $request->input('_token');

        return is_string($token) ? $token : null;
    }
}
