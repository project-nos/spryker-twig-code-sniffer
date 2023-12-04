<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Config;

use TwigCsFixer\Config\Config;

interface ConfigFactoryInterface
{
    /**
     * @return \TwigCsFixer\Config\Config
     */
    public function createConfig(): Config;
}
