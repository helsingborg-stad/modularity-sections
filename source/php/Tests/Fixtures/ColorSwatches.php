<?php

namespace Municipio\Helper;

class ColorSwatches
{
    public static function getColorUtilityClass(string $value): ?string
    {
        return match ($value) {
            'primary' => 'u-color--primary',
            default => null,
        };
    }
}
