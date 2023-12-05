<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Config;

use TwigCsFixer\Config\Config;

interface ConfigBuilderInterface
{
    /**
     * @param array<string> $paths
     * @param bool $disableCache
     *
     * @return \TwigCsFixer\Config\Config
     */
    public function build(array $paths = [], bool $disableCache = false): Config;
}
