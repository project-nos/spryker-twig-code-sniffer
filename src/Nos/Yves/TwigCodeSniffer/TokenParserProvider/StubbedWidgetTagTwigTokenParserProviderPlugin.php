<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer\TokenParserProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\TokenParserProviderPluginInterface;
use Nos\Yves\TwigCodeSniffer\TokenParser\StubbedWidgetTagTwigTokenParser;
use Twig\TokenParser\TokenParserInterface;

class StubbedWidgetTagTwigTokenParserProviderPlugin implements TokenParserProviderPluginInterface
{
    /**
     * @return \Twig\TokenParser\TokenParserInterface
     */
    public function provide(): TokenParserInterface
    {
        return new StubbedWidgetTagTwigTokenParser();
    }
}
