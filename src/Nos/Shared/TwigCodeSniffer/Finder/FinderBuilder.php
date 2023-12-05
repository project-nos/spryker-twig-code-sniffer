<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Finder;

use TwigCsFixer\File\Finder;

class FinderBuilder implements FinderBuilderInterface
{
    /**
     * @var \Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface
     */
    protected FinderFactoryInterface $finderFactory;

    /**
     * @var array<string>
     */
    protected array $paths;

    /**
     * @param \Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface $finderFactory
     * @param array<string> $paths
     */
    public function __construct(
        FinderFactoryInterface $finderFactory,
        array $paths = []
    ) {
        $this->finderFactory = $finderFactory;
        $this->paths = $paths;
    }

    /**
     * @param array<string> $paths
     *
     * @return \TwigCsFixer\File\Finder
     */
    public function build(array $paths = []): Finder
    {
        $finder = $this->finderFactory->create();

        if ($paths !== []) {
            return $finder->files()->in($paths);
        }

        return $finder->files()->in($this->paths);
    }
}
