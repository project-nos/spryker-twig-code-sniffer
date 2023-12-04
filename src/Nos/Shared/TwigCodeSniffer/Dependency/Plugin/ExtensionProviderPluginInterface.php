<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Dependency\Plugin;

use Twig\Extension\ExtensionInterface;

interface ExtensionProviderPluginInterface
{
    /**
     * @return \Twig\Extension\ExtensionInterface
     */
    public function provide(): ExtensionInterface;
}
