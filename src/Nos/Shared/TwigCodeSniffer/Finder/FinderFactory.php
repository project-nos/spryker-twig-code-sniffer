<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Finder;

use TwigCsFixer\File\Finder;

class FinderFactory implements FinderFactoryInterface
{
    /**
     * @return \TwigCsFixer\File\Finder
     */
    public function create(): Finder
    {
        return new Finder();
    }
}
