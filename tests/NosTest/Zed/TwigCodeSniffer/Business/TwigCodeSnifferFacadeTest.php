<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer\Business;

use Codeception\Test\Unit;
use Nos\Zed\TwigCodeSniffer\Business\Runner\RunnerInterface;
use NosTest\Zed\TwigCodeSniffer\TwigCodeSnifferBusinessTester;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Zed
 * @group TwigCodeSniffer
 * @group Business
 * @group TwigCodeSnifferFacadeTest
 * Add your own group annotations below this line
 */
class TwigCodeSnifferFacadeTest extends Unit
{
    /**
     * @var \NosTest\Zed\TwigCodeSniffer\TwigCodeSnifferBusinessTester
     */
    protected TwigCodeSnifferBusinessTester $tester;

    /**
     * @return void
     */
    public function testRun(): void
    {
        // Arrange
        $report = new Report([]);

        $inputMock = $this->getMockBuilder(InputInterface::class)->getMock();
        $outputMock = $this->getMockBuilder(OutputInterface::class)->getMock();

        $runnerMock = $this->createMock(RunnerInterface::class);
        $runnerMock->expects($this->once())
            ->method('run')
            ->with($inputMock, $outputMock)
            ->willReturn($report);

        $this->tester->mockFactoryMethod('createRunner', $runnerMock);

        // Act
        $result = $this->tester->getFacade()->run($inputMock, $outputMock);

        // Assert
        $this->assertSame($report, $result);
    }
}
