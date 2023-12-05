<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer;

use Spryker\Yves\Kernel\AbstractBundleConfig;

class TwigCodeSnifferConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getCacheFilePath(): string
    {
        return APPLICATION_ROOT_DIR . '/data/tmp/.twig-cs-yves.cache';
    }

    /**
     * @return array<string>
     */
    public function getPaths(): array
    {
        return [
            APPLICATION_ROOT_DIR . '/src/Pyz/Yves/*/Theme/*/**',
        ];
    }
}
