<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer;

use Nos\Zed\TwigCodeSniffer\Communication\Plugin\BlankEOFRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\BlockNameSpacingRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\DelimiterSpacingRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\EmptyLinesRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\IndentRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\OperatorNameSpacingRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\OperatorSpacingRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\TrailingCommaSingleLineRuleProviderPlugin;
use Nos\Zed\TwigCodeSniffer\Communication\Plugin\TrailingSpaceRuleProviderPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class TwigCodeSnifferDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const RULE_PROVIDER_PLUGINS = 'RULE_PROVIDER_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addRuleProviderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRuleProviderPlugins(Container $container): Container
    {
        $container->set(static::RULE_PROVIDER_PLUGINS, function () {
            return $this->getRuleProviderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Nos\Zed\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface>
     */
    protected function getRuleProviderPlugins(): array
    {
        return [
            new BlankEOFRuleProviderPlugin(),
            new BlockNameSpacingRuleProviderPlugin(),
            new DelimiterSpacingRuleProviderPlugin(),
            new EmptyLinesRuleProviderPlugin(),
            new IndentRuleProviderPlugin(),
            new OperatorNameSpacingRuleProviderPlugin(),
            new OperatorSpacingRuleProviderPlugin(),
            new TrailingCommaSingleLineRuleProviderPlugin(),
            new TrailingSpaceRuleProviderPlugin(),
        ];
    }
}
