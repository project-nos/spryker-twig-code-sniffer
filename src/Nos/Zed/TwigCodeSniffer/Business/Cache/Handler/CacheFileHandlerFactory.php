<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Cache\Handler;

use TwigCsFixer\Cache\FileHandler\CacheFileHandler;
use TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface;

class CacheFileHandlerFactory implements CacheFileHandlerFactoryInterface
{
    /**
     * @var string
     */
    protected string $cacheFilePath;

    /**
     * @param string $cacheFilePath
     */
    public function __construct(string $cacheFilePath)
    {
        $this->cacheFilePath = $cacheFilePath;
    }

    /**
     * @return \TwigCsFixer\Cache\FileHandler\CacheFileHandlerInterface
     */
    public function create(): CacheFileHandlerInterface
    {
        return new CacheFileHandler($this->cacheFilePath);
    }
}
