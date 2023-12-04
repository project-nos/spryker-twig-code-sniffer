<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Finder;

use TwigCsFixer\File\Finder;

interface FinderFactoryInterface
{
    /**
     * @return \TwigCsFixer\File\Finder
     */
    public function create(): Finder;
}
