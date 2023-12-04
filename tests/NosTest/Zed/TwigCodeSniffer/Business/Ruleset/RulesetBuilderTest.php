<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer\Business\Ruleset;

use Codeception\Test\Unit;
use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetBuilder;
use Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactoryInterface;
use TwigCsFixer\Rules\RuleInterface;
use TwigCsFixer\Ruleset\Ruleset;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Zed
 * @group TwigCodeSniffer
 * @group Business
 * @group Ruleset
 * @group RulesetBuilderTest
 * Add your own group annotations below this line
 */
class RulesetBuilderTest extends Unit
{
    /**
     * @return void
     */
    public function testBuild(): void
    {
        // Arrange
        $rulesetFactoryMock = $this->createMock(RulesetFactoryInterface::class);
        $rulesetFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new Ruleset());

        $ruleMock = $this->createMock(RuleInterface::class);

        $ruleProviderPluginMock = $this->createMock(RuleProviderPluginInterface::class);
        $ruleProviderPluginMock->expects($this->once())
            ->method('provide')
            ->willReturn($ruleMock);

        // Act
        $ruleset = (new RulesetBuilder($rulesetFactoryMock, [$ruleProviderPluginMock]))->build();

        // Assert
        $this->assertContains($ruleMock, $ruleset->getRules());
    }
}
