<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Config;

use Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface;
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
     * @param \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigFactoryInterface $configFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderBuilderInterface $finderBuilder
     */
    public function __construct(
        ConfigFactoryInterface $configFactory,
        FinderBuilderInterface $finderBuilder
    ) {
        $this->configFactory = $configFactory;
        $this->finderBuilder = $finderBuilder;
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

        return $config;
    }
}
