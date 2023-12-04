<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer\Business\Environment;

use Codeception\Test\Unit;
use Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactory;
use Twig\Extension\ExtensionInterface;
use Twig\TokenParser\TokenParserInterface;
use TwigCsFixer\Environment\StubbedEnvironment;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Zed
 * @group TwigCodeSniffer
 * @group Business
 * @group Environment
 * @group EnvironmentFactoryTest
 * Add your own group annotations below this line
 */
class EnvironmentFactoryTest extends Unit
{
    /**
     * @return void
     */
    public function testCreate(): void
    {
        // Arrange
        $extension = $this->createMock(ExtensionInterface::class);
        $extension->expects($this->any())
            ->method('getFilters')
            ->willReturn([]);

        $extension->expects($this->any())
            ->method('getFunctions')
            ->willReturn([]);

        $extension->expects($this->any())
            ->method('getTests')
            ->willReturn([]);

        $extension->expects($this->any())
            ->method('getTokenParsers')
            ->willReturn([]);

        $extension->expects($this->any())
            ->method('getNodeVisitors')
            ->willReturn([]);

        $tokenParser = $this->createMock(TokenParserInterface::class);

        // Act
        $environment = (new EnvironmentFactory())->create([$extension], [$tokenParser]);

        // Assert
        $this->assertInstanceOf(StubbedEnvironment::class, $environment);
        $this->assertContains($extension, $environment->getExtensions());
        $this->assertContains($tokenParser, $environment->getTokenParsers());
    }
}
