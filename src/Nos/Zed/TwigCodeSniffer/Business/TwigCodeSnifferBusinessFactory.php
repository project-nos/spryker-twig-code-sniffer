<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business;

use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilder;
use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactory;
use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactory;
use Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilder;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderFactory;
use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactory;
use Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactory;
use Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilder;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactory;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Runner\Runner;
use Nos\Zed\TwigCodeSniffer\Business\Runner\RunnerInterface;
use Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactory;
use Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactoryInterface;
use Nos\Zed\TwigCodeSniffer\TwigCodeSnifferDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use TwigCsFixer\Report\ReporterFactory;

/**
 * @method \Nos\Zed\TwigCodeSniffer\TwigCodeSnifferConfig getConfig()
 */
class TwigCodeSnifferBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Runner\RunnerInterface
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
     * @return \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilderInterface
     */
    protected function createConfigBuilder(): ConfigBuilderInterface
    {
        return new ConfigBuilder(
            $this->createConfigFactory(),
            $this->createFinderBuilder(),
            $this->createRulesetBuilder(),
        );
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface
     */
    protected function createConfigFactory(): ConfigFactoryInterface
    {
        return new ConfigFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface
     */
    protected function createFinderBuilder(): FinderBuilderInterface
    {
        return new FinderBuilder(
            $this->createFinderFactory(),
            $this->getConfig()->getIncludePaths(),
            $this->getConfig()->getExcludePaths(),
        );
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderFactoryInterface
     */
    protected function createFinderFactory(): FinderFactoryInterface
    {
        return new FinderFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilderInterface
     */
    protected function createRulesetBuilder(): RulesetBuilderInterface
    {
        return new RulesetBuilder(
            $this->createRulesetFactory(),
            $this->getRuleProviderPlugins(),
        );
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactoryInterface
     */
    protected function createRulesetFactory(): RulesetFactoryInterface
    {
        return new RulesetFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactoryInterface
     */
    protected function createEnvironmentFactory(): EnvironmentFactoryInterface
    {
        return new EnvironmentFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactoryInterface
     */
    protected function createTokenizerFactory(): TokenizerFactoryInterface
    {
        return new TokenizerFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactoryInterface
     */
    protected function createFixerFactory(): FixerFactoryInterface
    {
        return new FixerFactory();
    }

    /**
     * @return \Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactoryInterface
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
     * @return array<\Nos\Zed\TwigCodeSniffer\Business\RuleProviderPluginInterface>
     */
    protected function getRuleProviderPlugins(): array
    {
        return $this->getProvidedDependency(TwigCodeSnifferDependencyProvider::RULE_PROVIDER_PLUGINS);
    }
}
