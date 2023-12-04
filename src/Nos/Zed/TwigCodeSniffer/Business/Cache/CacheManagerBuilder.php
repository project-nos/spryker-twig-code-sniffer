<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Cache;

use Composer\InstalledVersions;
use Nos\Zed\TwigCodeSniffer\Business\Cache\Handler\CacheFileHandlerFactoryInterface;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Cache\Signature;
use TwigCsFixer\Ruleset\Ruleset;

class CacheManagerBuilder implements CacheManagerBuilderInterface
{
    /**
     * @var string
     */
    protected const PACKAGE_NAME = 'vincentlanglet/twig-cs-fixer';

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Cache\FileCacheManagerFactoryInterface
     */
    protected FileCacheManagerFactoryInterface $fileCacheManagerFactory;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Cache\Handler\CacheFileHandlerFactoryInterface
     */
    protected CacheFileHandlerFactoryInterface $cacheFileHandlerFactory;

    /**
     * @param \Nos\Zed\TwigCodeSniffer\Business\Cache\FileCacheManagerFactoryInterface $fileCacheManagerFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Cache\Handler\CacheFileHandlerFactoryInterface $cacheFileHandlerFactory
     */
    public function __construct(
        FileCacheManagerFactoryInterface $fileCacheManagerFactory,
        CacheFileHandlerFactoryInterface $cacheFileHandlerFactory
    ) {
        $this->fileCacheManagerFactory = $fileCacheManagerFactory;
        $this->cacheFileHandlerFactory = $cacheFileHandlerFactory;
    }

    /**
     * @param \TwigCsFixer\Ruleset\Ruleset $ruleset
     *
     * @return \TwigCsFixer\Cache\Manager\CacheManagerInterface
     */
    public function build(Ruleset $ruleset): CacheManagerInterface
    {
        return $this->fileCacheManagerFactory->create(
            $this->cacheFileHandlerFactory->create(),
            Signature::fromRuleset(
                \PHP_VERSION,
                InstalledVersions::getReference(static::PACKAGE_NAME) ?? '0',
                $ruleset,
            ),
        );
    }
}
