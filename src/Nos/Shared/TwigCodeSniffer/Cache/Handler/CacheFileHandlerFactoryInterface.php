<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Cache\Handler;

use TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface;

interface CacheFileHandlerFactoryInterface
{
    /**
     * @return \TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface
     */
    public function create(): CacheFileHandlerInterface;
}
