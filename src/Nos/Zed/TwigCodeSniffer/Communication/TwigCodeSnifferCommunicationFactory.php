<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use TwigCsFixer\Rules\Delimiter\BlockNameSpacingRule;
use TwigCsFixer\Rules\Delimiter\DelimiterSpacingRule;
use TwigCsFixer\Rules\Operator\OperatorNameSpacingRule;
use TwigCsFixer\Rules\Operator\OperatorSpacingRule;
use TwigCsFixer\Rules\Punctuation\TrailingCommaSingleLineRule;
use TwigCsFixer\Rules\RuleInterface;
use TwigCsFixer\Rules\Whitespace\BlankEOFRule;
use TwigCsFixer\Rules\Whitespace\EmptyLinesRule;
use TwigCsFixer\Rules\Whitespace\IndentRule;
use TwigCsFixer\Rules\Whitespace\TrailingSpaceRule;

class TwigCodeSnifferCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createBlankEOFRule(): RuleInterface
    {
        return new BlankEOFRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createBlockNameSpacingRule(): RuleInterface
    {
        return new BlockNameSpacingRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createDelimiterSpacingRule(): RuleInterface
    {
        return new DelimiterSpacingRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createEmptyLinesRule(): RuleInterface
    {
        return new EmptyLinesRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createIndentRule(): RuleInterface
    {
        return new IndentRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createOperatorNameSpacingRule(): RuleInterface
    {
        return new OperatorNameSpacingRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createOperatorSpacingRule(): RuleInterface
    {
        return new OperatorSpacingRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createTrailingCommaSingleLineRule(): RuleInterface
    {
        return new TrailingCommaSingleLineRule();
    }

    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function createTrailingSpaceRule(): RuleInterface
    {
        return new TrailingSpaceRule();
    }
}
