<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer;

use Spryker\Yves\Kernel\AbstractBundleConfig;

/**
 * @method \Nos\Shared\TwigCodeSniffer\TwigCodeSnifferConfig getSharedConfig()
 */
class TwigCodeSnifferConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getPaths(): array
    {
        $paths = [];
        foreach ($this->getSharedConfig()->getProjectNamespaces() as $projectNamespace) {
            $paths[] = APPLICATION_SOURCE_DIR . '/' . $projectNamespace . '/Yves/*/Theme/*/**';
        }

        return $paths;
    }

    /**
     * @return string
     */
    public function getCacheFilePath(): string
    {
        return APPLICATION_ROOT_DIR . '/data/tmp/.twig-cs-yves.cache';
    }
}
