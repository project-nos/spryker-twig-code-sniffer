<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer;

use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\BlankEOFRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\BlockNameSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\DelimiterSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\EmptyLinesRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\IndentRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\OperatorNameSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\OperatorSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\TrailingCommaSingleLineRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\TrailingSpaceRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\TokenParserProvider\StubbedShopCmsSlotTokenParserProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\TokenParserProvider\StubbedShopUiDefineTwigTokenParserProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\TokenParserProvider\StubbedWidgetTagTwigTokenParserProviderPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class TwigCodeSnifferDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const RULE_PROVIDER_PLUGINS = 'RULE_PROVIDER_PLUGINS';

    /**
     * @var string
     */
    public const TOKEN_PARSER_PLUGINS = 'TOKEN_PARSER_PROVIDER_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addRuleProviderPlugins($container);
        $container = $this->addTokenParserProviderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRuleProviderPlugins(Container $container): Container
    {
        $container->set(static::RULE_PROVIDER_PLUGINS, function (): array {
            return $this->getRuleProviderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface>
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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTokenParserProviderPlugins(Container $container): Container
    {
        $container->set(static::TOKEN_PARSER_PLUGINS, function (): array {
            return $this->getTokenParserProviderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface>
     */
    protected function getTokenParserProviderPlugins(): array
    {
        return [
            new StubbedShopCmsSlotTokenParserProviderPlugin(),
            new StubbedShopUiDefineTwigTokenParserProviderPlugin(),
            new StubbedWidgetTagTwigTokenParserProviderPlugin(),
        ];
    }
}
