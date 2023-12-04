<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Config;

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
     * @var array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface>
     */
    protected array $tokenParserProviderPlugins;

    /**
     * @param \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface $configFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface $finderBuilder
     * @param \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface $rulesetBuilder
     * @param array<\Nos\Zed\TwigCodeSniffer\Business\Config\TokenParserProviderPluginInterface> $tokenParserProviderPlugins
     */
    public function __construct(
        ConfigFactoryInterface $configFactory,
        FinderBuilderInterface $finderBuilder,
        RulesetBuilderInterface $rulesetBuilder,
        array $tokenParserProviderPlugins = []
    ) {
        $this->configFactory = $configFactory;
        $this->finderBuilder = $finderBuilder;
        $this->rulesetBuilder = $rulesetBuilder;
        $this->tokenParserProviderPlugins = $tokenParserProviderPlugins;
    }

    /**
     * @param array $paths
     * @param bool $disableCache
     *
     * @return \TwigCsFixer\Config\Config
     */
    public function build(array $paths = [], bool $disableCache = false): Config
    {
        $config = $this->configFactory->createConfig();
        $config->setFinder($this->finderBuilder->build($paths));

        if ($disableCache) {
            $config->setCacheFile(null);
            $config->setCacheManager(null);
        } // TODO::handle cache

        $config->setRuleset($this->rulesetBuilder->build());

        foreach ($this->tokenParserProviderPlugins as $tokenParserProviderPlugin) {
            $config->addTokenParser($tokenParserProviderPlugin->provide());
        }

        return $config;
    }
}
