<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Cache;

use Composer\InstalledVersions;
use Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactoryInterface;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Cache\Signature;
use TwigCsFixer\Ruleset\Ruleset;

class CacheManagerBuilder implements CacheManagerBuilderInterface
{
    /**
     * @var string
     */
    protected const PACKAGE_NAME = 'project-nos/spryker-twig-code-sniffer';

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Cache\FileCacheManagerFactoryInterface
     */
    protected FileCacheManagerFactoryInterface $fileCacheManagerFactory;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactoryInterface
     */
    protected CacheFileHandlerFactoryInterface $cacheFileHandlerFactory;

    /**
     * @param \Nos\Shared\TwigCodeSniffer\Cache\FileCacheManagerFactoryInterface $fileCacheManagerFactory
     * @param \Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactoryInterface $cacheFileHandlerFactory
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
