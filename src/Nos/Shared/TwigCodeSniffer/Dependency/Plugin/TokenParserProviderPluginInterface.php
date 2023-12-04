<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Dependency\Plugin;

use Twig\TokenParser\TokenParserInterface;

interface TokenParserProviderPluginInterface
{
    /**
     * @return \Twig\TokenParser\TokenParserInterface
     */
    public function provide(): TokenParserInterface;
}
