<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Cache;

use TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Cache\Manager\FileCacheManager;
use TwigCsFixer\Cache\Signature;

class FileCacheManagerFactory implements FileCacheManagerFactoryInterface
{
    /**
     * @param \TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface $handler
     * @param \TwigCsFixer\Cache\Signature $signature
     *
     * @return \TwigCsFixer\Cache\Manager\CacheManagerInterface
     */
    public function create(CacheFileHandlerInterface $handler, Signature $signature): CacheManagerInterface
    {
        return new FileCacheManager($handler, $signature);
    }
}
