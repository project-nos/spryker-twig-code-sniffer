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
use Spryker\Zed\Kernel\Communication\Console\Console;
use TwigCsFixer\Report\Report;

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
    public function testExecuteSuccessful(): void
    {
        // Arrange
        $report = new Report([]);
        $facade = $this->tester->mockFacadeMethod('run', $report);

        $command = new TwigCodeSnifferConsole();
        $command->setFacade($facade);

        $commandTester = $this->tester->getConsoleTester($command);

        $arguments = [
            'command' => $command->getName(),
        ];

        // Act
        $commandTester->execute($arguments);

        // Assert
        $this->assertSame(Console::CODE_SUCCESS, $commandTester->getStatusCode());
    }
}
