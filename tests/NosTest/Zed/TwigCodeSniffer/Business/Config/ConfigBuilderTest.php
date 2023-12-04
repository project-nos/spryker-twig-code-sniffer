<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer\Business\Config;

use Codeception\Test\Unit;
use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\ExtensionProviderPluginInterface;
use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface;
use Nos\Zed\TwigCodeSniffer\Business\Cache\CacheManagerBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilder;
use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface;
use Twig\Extension\ExtensionInterface;
use Twig\TokenParser\TokenParserInterface;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Config\Config;
use TwigCsFixer\File\Finder;
use TwigCsFixer\Ruleset\Ruleset;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Zed
 * @group TwigCodeSniffer
 * @group Business
 * @group Config
 * @group ConfigBuilderTest
 * Add your own group annotations below this line
 */
class ConfigBuilderTest extends Unit
{
    /**
     * @return void
     */
    public function testBuild(): void
    {
        // Arrange
        $configFactoryMock = $this->createMock(ConfigFactoryInterface::class);
        $configFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new Config());

        $finder = new Finder();
        $finderBuilderMock = $this->createMock(FinderBuilderInterface::class);
        $finderBuilderMock->expects($this->once())
            ->method('build')
            ->with(['path'])
            ->willReturn($finder);

        $ruleset = new Ruleset();
        $rulesetBuilderMock = $this->createMock(RulesetBuilderInterface::class);
        $rulesetBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($ruleset);

        $cacheManagerMock = $this->createMock(CacheManagerInterface::class);
        $cacheManagerBuilderMock = $this->createMock(CacheManagerBuilderInterface::class);
        $cacheManagerBuilderMock->expects($this->once())
            ->method('build')
            ->with($ruleset)
            ->willReturn($cacheManagerMock);

        $tokenParserMock = $this->createMock(TokenParserInterface::class);
        $tokenParserProviderPluginMock = $this->createMock(TokenParserProviderPluginInterface::class);
        $tokenParserProviderPluginMock->expects($this->once())
            ->method('provide')
            ->willReturn($tokenParserMock);

        $extensionMock = $this->createMock(ExtensionInterface::class);
        $extensionProviderPluginMock = $this->createMock(ExtensionProviderPluginInterface::class);
        $extensionProviderPluginMock->expects($this->once())
            ->method('provide')
            ->willReturn($extensionMock);

        $configBuilder = new ConfigBuilder(
            $configFactoryMock,
            $finderBuilderMock,
            $rulesetBuilderMock,
            $cacheManagerBuilderMock,
            [$tokenParserProviderPluginMock],
            [$extensionProviderPluginMock],
        );

        // Act
        $config = $configBuilder->build(['path']);

        // Assert
        $this->assertSame($finder, $config->getFinder());
        $this->assertSame($cacheManagerMock, $config->getCacheManager());
        $this->assertSame($ruleset, $config->getRuleset());
        $this->assertContains($tokenParserMock, $config->getTokenParsers());
        $this->assertContains($extensionMock, $config->getTwigExtensions());
    }
}
