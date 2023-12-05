<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Zed\TwigCodeSniffer;

use Codeception\Actor;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 * @method \Nos\Zed\TwigCodeSniffer\Business\TwigCodeSnifferFacadeInterface getFacade()
 *
 * @SuppressWarnings(\NosTest\Zed\TwigCodeSniffer\PHPMD)
 */
class TwigCodeSnifferBusinessTester extends Actor
{
    use _generated\TwigCodeSnifferBusinessTesterActions;

    /**
     * Define custom actions here
     */
}
