<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\TokenParser;

use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Twig\TokenStream;

/**
 * @see \SprykerShop\Yves\ShopCmsSlot\Twig\TokenParser\ShopCmsSlotTokenParser
 */
class StubbedShopCmsSlotTokenParser extends AbstractTokenParser
{
    /**
     * @var string
     */
    protected const TAG = 'cms_slot';

    /**
     * @var string
     */
    protected const NODE_AUTOFILLED = 'autoFilled';

    /**
     * @var string
     */
    protected const NODE_REQUIRED = 'required';

    /**
     * @var string
     */
    protected const NODE_WITH = 'with';

    /**
     * @var string
     */
    protected const PARAMETER_NAME_AUTOFILLED = 'autofilled';

    /**
     * @var string
     */
    protected const PARAMETER_NAME_REQUIRED = 'required';

    /**
     * @var string
     */
    protected const PARAMETER_NAME_WITH = 'with';

    /**
     * @return string
     */
    public function getTag(): string
    {
        return static::TAG;
    }

    /**
     * @param \Twig\Token $token
     *
     * @return \Twig\Node\Node
     */
    public function parse(Token $token): Node
    {
        $stream = $this->parser->getStream();
        $nodes = [];
        $attributes = [];

        $cmsSlotKey = $stream->expect(Token::STRING_TYPE)->getValue();

        $parameterAutoFilled = $this->parseAutoFilled($stream);

        if ($parameterAutoFilled) {
            $nodes[static::NODE_AUTOFILLED] = $parameterAutoFilled;
        }

        $parameterRequired = $this->parseRequired($stream);

        if ($parameterRequired) {
            $nodes[static::NODE_REQUIRED] = $parameterRequired;
        }

        $parameterWith = $this->parseWith($stream);

        if ($parameterWith) {
            $nodes[static::NODE_WITH] = $parameterWith;
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new Node($nodes, $attributes, $token->getLine(), $this->getTag());
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseAutoFilled(TokenStream $stream): ?Node
    {
        if (!$stream->nextIf(Token::NAME_TYPE, static::PARAMETER_NAME_AUTOFILLED)) {
            return null;
        }

        return $this->parser->getExpressionParser()->parseExpression();
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseRequired(TokenStream $stream): ?Node
    {
        if (!$stream->nextIf(Token::NAME_TYPE, static::PARAMETER_NAME_REQUIRED)) {
            return null;
        }

        return $this->parser->getExpressionParser()->parseExpression();
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseWith(TokenStream $stream): ?Node
    {
        if (!$stream->nextIf(Token::NAME_TYPE, static::PARAMETER_NAME_WITH)) {
            return null;
        }

        return $this->parser->getExpressionParser()->parseExpression();
    }
}
