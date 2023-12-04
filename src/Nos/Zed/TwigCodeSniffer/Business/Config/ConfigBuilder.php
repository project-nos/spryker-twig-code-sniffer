<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Config;

use Nos\Zed\TwigCodeSniffer\Business\Cache\CacheManagerBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface;
use TwigCsFixer\Config\Config;

class ConfigBuilder implements ConfigBuilderInterface
{
    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface
     */
    protected ConfigFactoryInterface $configFactory;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface
     */
    protected FinderBuilderInterface $finderBuilder;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface
     */
    protected RulesetBuilderInterface $rulesetBuilder;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Cache\CacheManagerBuilderInterface
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
     * @param \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface $configFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface $finderBuilder
     * @param \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface $rulesetBuilder
     * @param \Nos\Zed\TwigCodeSniffer\Business\Cache\CacheManagerBuilderInterface $cacheManagerBuilder
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
        $config = $this->configFactory->createConfig();
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
