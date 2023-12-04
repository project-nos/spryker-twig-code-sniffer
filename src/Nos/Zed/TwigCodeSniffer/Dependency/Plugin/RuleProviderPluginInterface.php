<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Dependency\Plugin;

use TwigCsFixer\Rules\RuleInterface;

interface RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface;
}
