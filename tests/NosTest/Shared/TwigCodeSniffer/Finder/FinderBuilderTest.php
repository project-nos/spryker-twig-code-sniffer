<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Shared\TwigCodeSniffer\Finder;

use Codeception\Test\Unit;
use Nos\Shared\TwigCodeSniffer\Finder\FinderBuilder;
use Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use TwigCsFixer\File\Finder;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Shared
 * @group TwigCodeSniffer
 * @group Finder
 * @group FinderBuilderTest
 * Add your own group annotations below this line
 */
class FinderBuilderTest extends Unit
{
    /**
     * @var \Nos\Shared\TwigCodeSniffer\Finder\FinderFactoryInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    protected FinderFactoryInterface&MockObject $finderFactoryMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->finderFactoryMock = $this->createMock(FinderFactoryInterface::class);
    }

    /**
     * @return void
     */
    public function testBuildWithPathsParameter(): void
    {
        // Arrange
        $finderBuilder = new FinderBuilder($this->finderFactoryMock);

        // Act
        $this->finderFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new Finder());

        $finder = $finderBuilder->build([codecept_data_dir('foo')]);

        // Assert
        $this->assertEquals(1, $finder->files()->count());
    }

    /**
     * @return void
     */
    public function testBuildWithConfiguredPaths(): void
    {
        // Arrange
        $finderBuilder = new FinderBuilder(
            $this->finderFactoryMock,
            [codecept_data_dir('foo'), codecept_data_dir('bar')],
        );

        // Act
        $this->finderFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new Finder());

        $finder = $finderBuilder->build();

        // Assert
        $this->assertEquals(2, $finder->files()->count());
    }
}
