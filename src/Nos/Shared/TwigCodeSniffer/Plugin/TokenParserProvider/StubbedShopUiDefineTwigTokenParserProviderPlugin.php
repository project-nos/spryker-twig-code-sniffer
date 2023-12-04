<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Plugin\TokenParserProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface;
use Nos\Shared\TwigCodeSniffer\TokenParser\StubbedShopUiDefineTwigTokenParser;
use Twig\TokenParser\TokenParserInterface;

class StubbedShopUiDefineTwigTokenParserProviderPlugin implements TokenParserProviderPluginInterface
{
    /**
     * @return \Twig\TokenParser\TokenParserInterface
     */
    public function provide(): TokenParserInterface
    {
        return new StubbedShopUiDefineTwigTokenParser();
    }
}
