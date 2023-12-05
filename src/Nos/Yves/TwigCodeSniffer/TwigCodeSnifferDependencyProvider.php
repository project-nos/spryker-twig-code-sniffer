<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer;

use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\BlankEOFRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\BlockNameSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\DelimiterSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\EmptyLinesRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\IndentRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\OperatorNameSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\OperatorSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\PunctuationSpacingRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\TrailingCommaSingleLineRuleProviderPlugin;
use Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider\TrailingSpaceRuleProviderPlugin;
use Nos\Yves\TwigCodeSniffer\TokenParserProvider\StubbedShopCmsSlotTokenParserProviderPlugin;
use Nos\Yves\TwigCodeSniffer\TokenParserProvider\StubbedShopUiDefineTwigTokenParserProviderPlugin;
use Nos\Yves\TwigCodeSniffer\TokenParserProvider\StubbedWidgetTagTwigTokenParserProviderPlugin;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class TwigCodeSnifferDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const RULE_PROVIDER_PLUGINS = 'RULE_PROVIDER_PLUGINS';

    /**
     * @var string
     */
    public const TOKEN_PARSER_PROVIDER_PLUGINS = 'TOKEN_PARSER_PROVIDER_PLUGINS';

    /**
     * @var string
     */
    public const EXTENSION_PROVIDER_PLUGINS = 'EXTENSION_PROVIDER_PLUGINS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addRuleProviderPlugins($container);
        $container = $this->addTokenParserProviderPlugins($container);
        $container = $this->addExtensionProviderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
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
            new PunctuationSpacingRuleProviderPlugin(),
            new TrailingCommaSingleLineRuleProviderPlugin(),
            new TrailingSpaceRuleProviderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addTokenParserProviderPlugins(Container $container): Container
    {
        $container->set(static::TOKEN_PARSER_PROVIDER_PLUGINS, function (): array {
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

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addExtensionProviderPlugins(Container $container): Container
    {
        $container->set(static::EXTENSION_PROVIDER_PLUGINS, function (): array {
            return $this->getExtensionProviderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\ExtensionProviderPluginInterface>
     */
    protected function getExtensionProviderPlugins(): array
    {
        return [];
    }
}
