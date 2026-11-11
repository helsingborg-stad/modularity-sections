<?php

namespace Municipio\Helper;

class ColorSwatches
{
    public static function normalizeColorPairRole(string $value): ?string
    {
        return match ($value) {
            'primary' => 'primary',
            '#ffffff' => 'secondary',
            default => null,
        };
    }
}
