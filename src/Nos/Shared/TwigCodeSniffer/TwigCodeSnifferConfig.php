<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer;

use Spryker\Shared\Kernel\AbstractSharedConfig;
use Spryker\Shared\Kernel\KernelConstants;

class TwigCodeSnifferConfig extends AbstractSharedConfig
{
    /**
     * @return array<string>
     */
    public function getProjectNamespaces(): array
    {
        return $this->get(KernelConstants::PROJECT_NAMESPACES);
    }
}
