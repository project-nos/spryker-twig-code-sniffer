<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Config;

use TwigCsFixer\Config\Config;

class ConfigFactory implements ConfigFactoryInterface
{
    /**
     * @return \TwigCsFixer\Config\Config
     */
    public function createConfig(): Config
    {
        return new Config();
    }
}
