<?php

declare(strict_types=1);

namespace ModularitySections;

use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private function app(): App
    {
        return (new \ReflectionClass(App::class))->newInstanceWithoutConstructor();
    }

    #[RunInSeparateProcess]
    public function testPaletteIntegrationIsOptional(): void
    {
        class_alias(NoPaletteColorSwatches::class, 'Municipio\\Helper\\ColorSwatches');
        $section = ['context' => ['sections'], 'background' => '#ffffff', 'textColor' => 'dark'];
        self::assertSame('#ffffff', $this->app()->normalizePaletteValue('#ffffff'));
        self::assertSame($section, $this->app()->applyPalettePair($section));
    }

    #[RunInSeparateProcess]
    public function testMapsLegacyColorsAndUsesThePairForSections(): void
    {
        require_once __DIR__ . '/Tests/Fixtures/ColorSwatches.php';
        self::assertSame('secondary', $this->app()->normalizePaletteValue('#ffffff'));
        self::assertSame('', $this->app()->normalizePaletteValue(''));
        self::assertSame('unknown', $this->app()->normalizePaletteValue('unknown'));
        $section = ['context' => ['sections'], 'background' => '#ffffff', 'textColor' => 'dark'];
        self::assertSame(['context' => ['sections'], 'background' => 'secondary', 'textColor' => ''], $this->app()->applyPalettePair($section));
        $section['context'] = ['other'];
        self::assertSame($section, $this->app()->applyPalettePair($section));
        $section = ['context' => ['sections'], 'background' => '', 'textColor' => 'light'];
        self::assertSame($section, $this->app()->applyPalettePair($section));
    }
}

/** Represents an older theme without the palette role API. */
class NoPaletteColorSwatches {}
