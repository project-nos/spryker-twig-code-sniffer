<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Dependency\Plugin;

use TwigCsFixer\Rules\RuleInterface;

interface RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface;
}
