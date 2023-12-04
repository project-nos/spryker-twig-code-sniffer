<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class TwigCodeSnifferConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getIncludePaths(): array
    {
        return [
            APPLICATION_ROOT_DIR . '/src/Pyz/Yves/*/Theme/*/**',
        ];
    }

    /**
     * @return array<string>
     */
    public function getExcludePaths(): array
    {
        return [];
    }
}
