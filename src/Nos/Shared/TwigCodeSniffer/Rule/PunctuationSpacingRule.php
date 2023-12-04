<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Rule;

use TwigCsFixer\Rules\AbstractSpacingRule;
use TwigCsFixer\Token\Token;
use Webmozart\Assert\Assert;

class PunctuationSpacingRule extends AbstractSpacingRule
{
    /**
     * @var array<string, int>
     */
    protected const SPACE_BEFORE = [
        ')' => 0,
        ']' => 0,
        '}' => 1,
        ':' => 0,
        '.' => 0,
        ',' => 0,
        '|' => 1,
    ];

    /**
     * @var array<string, int>
     */
    protected const SPACE_AFTER = [
        '(' => 0,
        '[' => 0,
        '{' => 1,
        '.' => 0,
        '|' => 1,
        ':' => 1,
        ',' => 1,
    ];

    /**
     * @param int $tokenPosition
     * @param array<int, \TwigCsFixer\Token\Token> $tokens
     *
     * @return int|null
     */
    protected function getSpaceBefore(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];
        if (!$this->isTokenMatching($token, Token::PUNCTUATION_TYPE)) {
            return null;
        }

        return static::SPACE_BEFORE[$token->getValue()] ?? null;
    }

    /**
     * @param int $tokenPosition
     * @param array<int, \TwigCsFixer\Token\Token> $tokens
     *
     * @return int|null
     */
    protected function getSpaceAfter(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];

        if (!$this->isTokenMatching($token, Token::PUNCTUATION_TYPE)) {
            return null;
        }

        $nextPosition = $this->findNext(Token::WHITESPACE_TOKENS, $tokens, $tokenPosition + 1, true);
        Assert::notFalse($nextPosition, 'A PUNCTUATION_TYPE cannot be the last non-empty token');

        // We cannot change spaces after a token, if the next one has a constraint: `[1,2,3,]`.
        if ($this->getSpaceBefore($nextPosition, $tokens) !== null) {
            return null;
        }

        return static::SPACE_AFTER[$token->getValue()] ?? null;
    }
}
