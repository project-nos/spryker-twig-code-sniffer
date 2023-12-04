<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Finder;

use TwigCsFixer\File\Finder;

class FinderBuilder implements FinderBuilderInterface
{
    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderFactoryInterface
     */
    protected FinderFactoryInterface $finderFactory;

    /**
     * @var array<string>
     */
    protected array $includePaths;

    /**
     * @var array<string>
     */
    protected array $excludePaths;

    /**
     * @param \Nos\Zed\TwigCodeSniffer\Business\Finder\FinderFactoryInterface $finderFactory
     * @param array<string> $includePaths
     * @param array<string> $excludePaths
     */
    public function __construct(
        FinderFactoryInterface $finderFactory,
        array $includePaths = [],
        array $excludePaths = []
    ) {
        $this->finderFactory = $finderFactory;
        $this->includePaths = $includePaths;
        $this->excludePaths = $excludePaths;
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

        return $finder->files()->in($this->includePaths)->exclude($this->excludePaths);
    }
}
