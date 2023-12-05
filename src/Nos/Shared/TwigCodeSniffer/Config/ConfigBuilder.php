<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Config;

use Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Finder\FinderBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilderInterface;
use TwigCsFixer\Config\Config;

class ConfigBuilder implements ConfigBuilderInterface
{
    /**
     * @var \Nos\Shared\TwigCodeSniffer\Config\ConfigFactoryInterface
     */
    protected ConfigFactoryInterface $configFactory;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Finder\FinderBuilderInterface
     */
    protected FinderBuilderInterface $finderBuilder;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilderInterface
     */
    protected RulesetBuilderInterface $rulesetBuilder;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilderInterface
     */
    protected CacheManagerBuilderInterface $cacheManagerBuilder;

    /**
     * @var array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface>
     */
    protected array $tokenParserProviderPlugins;

    /**
     * @var array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\ExtensionProviderPluginInterface>
     */
    protected array $extensionProviderPlugins;

    /**
     * @param \Nos\Shared\TwigCodeSniffer\Config\ConfigFactoryInterface $configFactory
     * @param \Nos\Shared\TwigCodeSniffer\Finder\FinderBuilderInterface $finderBuilder
     * @param \Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilderInterface $rulesetBuilder
     * @param \Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilderInterface $cacheManagerBuilder
     * @param array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface> $tokenParserProviderPlugins
     * @param array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\ExtensionProviderPluginInterface> $extensionProviderPlugins
     */
    public function __construct(
        ConfigFactoryInterface $configFactory,
        FinderBuilderInterface $finderBuilder,
        RulesetBuilderInterface $rulesetBuilder,
        CacheManagerBuilderInterface $cacheManagerBuilder,
        array $tokenParserProviderPlugins = [],
        array $extensionProviderPlugins = []
    ) {
        $this->configFactory = $configFactory;
        $this->finderBuilder = $finderBuilder;
        $this->rulesetBuilder = $rulesetBuilder;
        $this->cacheManagerBuilder = $cacheManagerBuilder;
        $this->tokenParserProviderPlugins = $tokenParserProviderPlugins;
        $this->extensionProviderPlugins = $extensionProviderPlugins;
    }

    /**
     * @param array<string> $paths
     * @param bool $disableCache
     *
     * @return \TwigCsFixer\Config\Config
     */
    public function build(array $paths = [], bool $disableCache = false): Config
    {
        $config = $this->configFactory->create();
        $config->setFinder($this->finderBuilder->build($paths));
        $ruleset = $this->rulesetBuilder->build();

        if (!$disableCache) {
            $config->setCacheManager($this->cacheManagerBuilder->build($ruleset));
        }

        $config->setRuleset($ruleset);
        foreach ($this->tokenParserProviderPlugins as $tokenParserProviderPlugin) {
            $config->addTokenParser($tokenParserProviderPlugin->provide());
        }

        foreach ($this->extensionProviderPlugins as $extensionProviderPlugin) {
            $config->addTwigExtension($extensionProviderPlugin->provide());
        }

        return $config;
    }
}
