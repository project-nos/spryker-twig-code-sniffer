<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Finder;

use TwigCsFixer\File\Finder;

interface FinderBuilderInterface
{
    /**
     * @param array $paths
     *
     * @return \TwigCsFixer\File\Finder
     */
    public function build(array $paths = []): Finder;
}
