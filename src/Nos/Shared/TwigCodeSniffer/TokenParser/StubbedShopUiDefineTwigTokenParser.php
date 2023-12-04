<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\TokenParser;

use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * @see \SprykerShop\Yves\ShopUi\Twig\TokenParser\ShopUiDefineTwigTokenParser
 */
class StubbedShopUiDefineTwigTokenParser extends AbstractTokenParser
{
    /**
     * @var string
     */
    protected const TAG = 'define';

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
        $parser = $this->parser;
        $stream = $parser->getStream();
        $name = $stream->expect(Token::NAME_TYPE)->getValue();
        $stream->expect(Token::OPERATOR_TYPE, '=');
        $value = $parser->getExpressionParser()->parseExpression();
        $line = $token->getLine();
        $tag = $this->getTag();
        $stream->expect(Token::BLOCK_END_TYPE);

        return new Node(
            ['value' => $value],
            ['name' => $name],
            $line,
            $tag,
        );
    }
}
