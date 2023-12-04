<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use TwigCsFixer\Rules\Delimiter\BlockNameSpacingRule;
use TwigCsFixer\Rules\RuleInterface;

class BlockNameSpacingRuleProviderPlugin implements RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface
    {
        return new BlockNameSpacingRule();
    }
}
