<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

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
