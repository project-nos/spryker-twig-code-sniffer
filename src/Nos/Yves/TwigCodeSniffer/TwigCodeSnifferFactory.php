<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer;

use Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilder;
use Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Cache\FileCacheManagerFactory;
use Nos\Shared\TwigCodeSniffer\Cache\FileCacheManagerFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactory;
use Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Config\ConfigBuilder;
use Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Config\ConfigFactory;
use Nos\Shared\TwigCodeSniffer\Config\ConfigFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactory;
use Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Finder\FinderBuilder;
use Nos\Shared\TwigCodeSniffer\Finder\FinderBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Finder\FinderFactory;
use Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Fixer\FixerFactory;
use Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Linter\LinterFactory;
use Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilder;
use Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Ruleset\RulesetFactory;
use Nos\Shared\TwigCodeSniffer\Ruleset\RulesetFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Runner\Runner;
use Nos\Shared\TwigCodeSniffer\Runner\RunnerInterface;
use Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactory;
use Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use TwigCsFixer\Report\ReporterFactory;

/**
 * @method \Nos\Yves\TwigCodeSniffer\TwigCodeSnifferConfig getConfig()
 */
class TwigCodeSnifferFactory extends AbstractFactory
{
    /**
     * @return \Nos\Shared\TwigCodeSniffer\Runner\RunnerInterface
     */
    public function createRunner(): RunnerInterface
    {
        return new Runner(
            $this->createConfigBuilder(),
            $this->createEnvironmentFactory(),
            $this->createTokenizerFactory(),
            $this->createFixerFactory(),
            $this->createLinterFactory(),
            $this->createReporterFactory(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface
     */
    protected function createConfigBuilder(): ConfigBuilderInterface
    {
        return new ConfigBuilder(
            $this->createConfigFactory(),
            $this->createFinderBuilder(),
            $this->createRulesetBuilder(),
            $this->createCacheManagerBuilder(),
            $this->getTokenParserProviderPlugins(),
            $this->getExtensionProviderPlugins(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Config\ConfigFactoryInterface
     */
    protected function createConfigFactory(): ConfigFactoryInterface
    {
        return new ConfigFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Finder\FinderBuilderInterface
     */
    protected function createFinderBuilder(): FinderBuilderInterface
    {
        return new FinderBuilder(
            $this->createFinderFactory(),
            $this->getConfig()->getPaths(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface
     */
    protected function createFinderFactory(): FinderFactoryInterface
    {
        return new FinderFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Ruleset\RulesetBuilderInterface
     */
    protected function createRulesetBuilder(): RulesetBuilderInterface
    {
        return new RulesetBuilder(
            $this->createRulesetFactory(),
            $this->getRuleProviderPlugins(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Ruleset\RulesetFactoryInterface
     */
    protected function createRulesetFactory(): RulesetFactoryInterface
    {
        return new RulesetFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Cache\CacheManagerBuilderInterface
     */
    protected function createCacheManagerBuilder(): CacheManagerBuilderInterface
    {
        return new CacheManagerBuilder(
            $this->createFileCacheManagerFactory(),
            $this->createCacheFileHandlerFactory(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Cache\FileCacheManagerFactoryInterface
     */
    protected function createFileCacheManagerFactory(): FileCacheManagerFactoryInterface
    {
        return new FileCacheManagerFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Cache\Handler\CacheFileHandlerFactoryInterface
     */
    protected function createCacheFileHandlerFactory(): CacheFileHandlerFactoryInterface
    {
        return new CacheFileHandlerFactory(
            $this->getConfig()->getCacheFilePath(),
        );
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface
     */
    protected function createEnvironmentFactory(): EnvironmentFactoryInterface
    {
        return new EnvironmentFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface
     */
    protected function createTokenizerFactory(): TokenizerFactoryInterface
    {
        return new TokenizerFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface
     */
    protected function createFixerFactory(): FixerFactoryInterface
    {
        return new FixerFactory();
    }

    /**
     * @return \Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface
     */
    protected function createLinterFactory(): LinterFactoryInterface
    {
        return new LinterFactory();
    }

    /**
     * @return \TwigCsFixer\Report\ReporterFactory
     */
    protected function createReporterFactory(): ReporterFactory
    {
        return new ReporterFactory();
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface>
     */
    protected function getTokenParserProviderPlugins(): array
    {
        return $this->getProvidedDependency(TwigCodeSnifferDependencyProvider::TOKEN_PARSER_PROVIDER_PLUGINS);
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\ExtensionProviderPluginInterface>
     */
    protected function getExtensionProviderPlugins(): array
    {
        return $this->getProvidedDependency(TwigCodeSnifferDependencyProvider::EXTENSION_PROVIDER_PLUGINS);
    }

    /**
     * @return array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface>
     */
    protected function getRuleProviderPlugins(): array
    {
        return $this->getProvidedDependency(TwigCodeSnifferDependencyProvider::RULE_PROVIDER_PLUGINS);
    }
}
