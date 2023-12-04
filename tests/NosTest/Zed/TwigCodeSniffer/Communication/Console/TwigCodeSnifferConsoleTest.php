<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer\Communication\Console;

use Codeception\Test\Unit;
use Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole;
use NosTest\Zed\TwigCodeSniffer\TwigCodeSnifferCommunicationTester;
use SplFileInfo;
use Spryker\Zed\Kernel\Communication\Console\Console;
use TwigCsFixer\Report\Report;
use TwigCsFixer\Report\Violation;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Zed
 * @group TwigCodeSniffer
 * @group Communication
 * @group Console
 * @group TwigCodeSnifferConsoleTest
 * Add your own group annotations below this line
 */
class TwigCodeSnifferConsoleTest extends Unit
{
    /**
     * @var \NosTest\Zed\TwigCodeSniffer\TwigCodeSnifferCommunicationTester
     */
    protected TwigCodeSnifferCommunicationTester $tester;

    /**
     * @return void
     */
    public function testExecuteShouldSucceedWhenCodeStyleIsValid(): void
    {
        // Arrange
        $report = new Report([]);

        $facadeMock = $this->tester->mockFacadeMethod('run', $report);

        $command = new TwigCodeSnifferConsole();
        $command->setFacade($facadeMock);

        $commandTester = $this->tester->getConsoleTester($command);

        // Act
        $commandTester->execute(['command' => $command->getName()]);

        // Assert
        $this->assertSame(Console::CODE_SUCCESS, $commandTester->getStatusCode());
    }

    /**
     * @return void
     */
    public function testExecuteShouldFailWhenCodeStyleIsInvalid(): void
    {
        // Arrange
        $report = new Report([new SplFileInfo('path')]);
        $report = $report->addViolation(new Violation(Violation::LEVEL_ERROR, 'message', 'path'));

        $facadeMock = $this->tester->mockFacadeMethod('run', $report);

        $command = new TwigCodeSnifferConsole();
        $command->setFacade($facadeMock);

        $commandTester = $this->tester->getConsoleTester($command);

        // Act
        $commandTester->execute(['command' => $command->getName()]);

        // Assert
        $this->assertSame(Console::CODE_ERROR, $commandTester->getStatusCode());
    }
}
