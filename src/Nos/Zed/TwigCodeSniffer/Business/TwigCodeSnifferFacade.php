<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;

/**
 * @method \Nos\Zed\TwigCodeSniffer\Business\TwigCodeSnifferBusinessFactory getFactory()
 */
class TwigCodeSnifferFacade extends AbstractFacade implements TwigCodeSnifferFacadeInterface
{
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \TwigCsFixer\Report\Report
     */
    public function run(InputInterface $input, OutputInterface $output): Report
    {
        return $this->getFactory()->createRunner()->run($input, $output);
    }
}
