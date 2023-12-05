<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Finder;

use TwigCsFixer\File\Finder;

interface FinderBuilderInterface
{
    /**
     * @param array<string> $paths
     *
     * @return \TwigCsFixer\File\Finder
     */
    public function build(array $paths = []): Finder;
}
