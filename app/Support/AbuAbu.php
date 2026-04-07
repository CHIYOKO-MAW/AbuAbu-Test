<?php

namespace App\Support;

use Illuminate\Support\Arr;

class AbuAbu
{
    public static function lang(?string $lang): string
    {
        return in_array($lang, ['id', 'en'], true) ? $lang : 'id';
    }

    public static function text(string|array|null $value, string $lang = 'id'): string
    {
        if (is_string($value)) {
            return $value;
        }

        if (! is_array($value) || $value === []) {
            return '';
        }

        if (array_key_exists($lang, $value) && is_string($value[$lang])) {
            return $value[$lang];
        }

        foreach (['id', 'en'] as $fallback) {
            if (array_key_exists($fallback, $value) && is_string($value[$fallback])) {
                return $value[$fallback];
            }
        }

        $first = Arr::first($value);

        return is_string($first) ? $first : '';
    }
}
