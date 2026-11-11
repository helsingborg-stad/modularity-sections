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
        self::assertSame($section, $this->app()->applyPalettePair($section));
    }

    #[RunInSeparateProcess]
    public function testUsesSavedPairsWithoutTransformingLegacyColors(): void
    {
        require_once __DIR__ . '/Tests/Fixtures/ColorSwatches.php';
        $section = ['context' => ['sections'], 'background' => 'primary', 'textColor' => 'dark'];
        self::assertSame(['context' => ['sections'], 'background' => 'primary', 'textColor' => ''], $this->app()->applyPalettePair($section));
        $section['context'] = ['other'];
        self::assertSame($section, $this->app()->applyPalettePair($section));
        $section = ['context' => ['sections'], 'background' => '#ffffff', 'textColor' => 'dark'];
        self::assertSame($section, $this->app()->applyPalettePair($section));
        $section = ['context' => ['sections'], 'background' => '', 'textColor' => 'light'];
        self::assertSame($section, $this->app()->applyPalettePair($section));
    }
}

/** Represents an older theme without the palette role API. */
class NoPaletteColorSwatches {}
