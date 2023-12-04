<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Finder;

use TwigCsFixer\File\Finder;

interface FinderFactoryInterface
{
    /**
     * @return \TwigCsFixer\File\Finder
     */
    public function create(): Finder;
}
