<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer\TokenParser;

use Twig\Error\SyntaxError;
use Twig\Node\Expression\ArrayExpression;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Twig\TokenStream;

/**
 * @see \SprykerShop\Yves\ShopApplication\Twig\Widget\TokenParser\WidgetTagTwigTokenParser
 */
class StubbedWidgetTagTwigTokenParser extends AbstractTokenParser
{
    /**
     * @var string
     */
    protected const TAG = 'widget';

    /**
     * @var string
     */
    protected const NODE_ARGS = 'args';

    /**
     * @var string
     */
    protected const NODE_USE = 'use';

    /**
     * @var string
     */
    protected const NODE_WITH = 'with';

    /**
     * @var string
     */
    protected const NODE_ELSEWIDGETS = 'elsewidgets';

    /**
     * @var string
     */
    protected const NODE_NOWIDGET = 'nowidget';

    /**
     * @var string
     */
    protected const NODE_WIDGET_EXPRESSION = 'widgetExpression';

    /**
     * @var string
     */
    protected const ATTRIBUTE_ONLY = 'only';

    /**
     * @var string
     */
    protected const ATTRIBUTE_PARENT_TEMPLATE_NAME = 'parentTemplateName';

    /**
     * @var string
     */
    protected const ATTRIBUTE_INDEX = 'index';

    /**
     * @var string
     */
    protected const ATTRIBUTE_ELSEWIDGET_CASE = 'elseWidgetCase';

    /**
     * @var string
     */
    protected const VARIABLE_WIDGET_TEMPLATE_PATH = '_widgetTemplatePath';

    /**
     * @var string
     */
    protected const TOKEN_ELSEWIDGET = 'elsewidget';

    /**
     * @var string
     */
    protected const TOKEN_NOWIDGET = 'nowidget';

    /**
     * @var string
     */
    protected const TOKEN_ENDWIDGET = 'endwidget';

    /**
     * @var string
     */
    protected const TOKEN_ONLY = 'only';

    /**
     * @var string
     */
    protected const TOKEN_WITH = 'with';

    /**
     * @var string
     */
    protected const TOKEN_USE = 'use';

    /**
     * @var string
     */
    protected const TOKEN_ARGS = 'args';

    /**
     * @return string
     */
    public function getTag()
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

        [$nodes] = $this->parseWidgetName($stream);
        [$nodes, $attributes] = $this->parseWidgetTagHead($nodes, $stream);
        [$nodes, $attributes] = $this->parseWidgetTagBody($nodes, $attributes, $stream, $token);
        [$nodes, $attributes] = $this->parseWidgetTagForks($nodes, $attributes, $stream, $token);

        return new Node($nodes, $attributes, $token->getLine(), $this->getTag());
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return array
     */
    protected function parseWidgetName(TokenStream $stream): array
    {
        $nodes = [];

        if ($stream->test(Token::STRING_TYPE)) {
            $stream->expect(Token::STRING_TYPE)->getValue();

            return [$nodes];
        }

        $nodes[static::NODE_WIDGET_EXPRESSION] = $this->parser->getExpressionParser()->parseExpression();

        return [$nodes];
    }

    /**
     * @param array $nodes
     * @param \Twig\TokenStream $stream
     *
     * @throws \Twig\Error\SyntaxError
     *
     * @return array
     */
    protected function parseWidgetTagHead(array $nodes, TokenStream $stream): array
    {
        $attributes = [];

        $args = $this->parseArgs($stream);
        if ($args) {
            if (isset($nodes[static::NODE_WIDGET_EXPRESSION])) {
                throw new SyntaxError(
                    sprintf('Ambiguous use of "args", can be used only when widget\'s name defined as a string literal.'),
                    $stream->getCurrent()->getLine(),
                );
            }
            $nodes[static::NODE_ARGS] = $args;
        }

        $use = $this->parseUse($stream);
        if ($use) {
            $nodes[static::NODE_USE] = $use;
        }

        $with = $this->parseWith($stream);
        if ($with) {
            $nodes[static::NODE_WITH] = $with;
        }

        $attributes[static::ATTRIBUTE_ONLY] = $this->parseOnly($stream);
        $attributes[static::ATTRIBUTE_ELSEWIDGET_CASE] = false;

        $stream->expect(Token::BLOCK_END_TYPE);

        return [$nodes, $attributes];
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseArgs(TokenStream $stream): ?Node
    {
        if ($stream->nextIf(Token::NAME_TYPE, static::TOKEN_ARGS)) {
            return $this->parser->getExpressionParser()->parseExpression();
        }

        return null;
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseUse(TokenStream $stream): ?Node
    {
        if ($stream->nextIf(Token::NAME_TYPE, static::TOKEN_USE)) {
            return $this->parser->getExpressionParser()->parseExpression();
        }

        return null;
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node|null
     */
    protected function parseWith(TokenStream $stream): ?Node
    {
        if ($stream->nextIf(Token::NAME_TYPE, static::TOKEN_WITH)) {
            return $this->parser->getExpressionParser()->parseExpression();
        }

        return null;
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return bool
     */
    protected function parseOnly(TokenStream $stream): bool
    {
        if ($stream->nextIf(Token::NAME_TYPE, static::TOKEN_ONLY)) {
            return true;
        }

        return false;
    }

    /**
     * @param array $nodes
     * @param array $attributes
     * @param \Twig\TokenStream $stream
     * @param \Twig\Token $token
     *
     * @return array
     */
    protected function parseWidgetTagBody(array $nodes, array $attributes, TokenStream $stream, Token $token): array
    {
        // fake extension from the (calculated) widget template
        $stream->injectTokens([
            new Token(Token::BLOCK_START_TYPE, '', $token->getLine()),
            new Token(Token::NAME_TYPE, 'extends', $token->getLine()),
            new Token(Token::NAME_TYPE, static::VARIABLE_WIDGET_TEMPLATE_PATH, $token->getLine()),
            new Token(Token::BLOCK_END_TYPE, '', $token->getLine()),
        ]);

        $body = $this->parser->parse($stream, [$this, 'decideIfFork']);

        $this->parser->embedTemplate($body);

        $attributes[static::ATTRIBUTE_PARENT_TEMPLATE_NAME] = $body->getTemplateName();
        $attributes[static::ATTRIBUTE_INDEX] = $body->getAttribute('index');

        return [$nodes, $attributes];
    }

    /**
     * @param array $nodes
     * @param array $attributes
     * @param \Twig\TokenStream $stream
     * @param \Twig\Token $token
     *
     * @throws \Twig\Error\SyntaxError
     *
     * @return array
     */
    protected function parseWidgetTagForks(array $nodes, array $attributes, TokenStream $stream, Token $token): array
    {
        $end = false;
        $elsewidgets = [];
        while (!$end) {
            switch ($stream->next()->getValue()) {
                case static::TOKEN_ELSEWIDGET:
                    $index = count($elsewidgets) / 2;
                    $elsewidgets[] = new ConstantExpression($index, $token->getLine());
                    $elsewidgets[] = $this->parseElsewidget($stream, $token);

                    break;
                case static::TOKEN_NOWIDGET:
                    $nodes[static::NODE_NOWIDGET] = $this->parseNowidget($stream);

                    break;
                case static::TOKEN_ENDWIDGET:
                    $end = true;

                    break;
                default:
                    throw new SyntaxError(
                        sprintf(
                            'Unexpected end of template. Twig was looking for the following tags "nowidget", or "endwidget" to close the "widget" block started at line %d).',
                            $token->getLine(),
                        ),
                        $stream->getCurrent()->getLine(),
                        $stream->getSourceContext(),
                    );
            }
        }

        if ($elsewidgets) {
            $nodes[static::NODE_ELSEWIDGETS] = new ArrayExpression($elsewidgets, $token->getLine());
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return [$nodes, $attributes];
    }

    /**
     * @param \Twig\TokenStream $stream
     * @param \Twig\Token $token
     *
     * @return \Twig\Node\Node
     */
    protected function parseElsewidget(TokenStream $stream, Token $token): Node
    {
        [$nodes] = $this->parseWidgetName($stream);
        [$nodes, $attributes] = $this->parseWidgetTagHead($nodes, $stream);
        [$nodes, $attributes] = $this->parseWidgetTagBody($nodes, $attributes, $stream, $token);

        $attributes[static::ATTRIBUTE_ELSEWIDGET_CASE] = true;

        return new Node($nodes, $attributes, $token->getLine(), $this->getTag());
    }

    /**
     * @param \Twig\TokenStream $stream
     *
     * @return \Twig\Node\Node
     */
    protected function parseNowidget(TokenStream $stream): Node
    {
        $stream->expect(Token::BLOCK_END_TYPE);

        return $this->parser->subparse([$this, 'decideIfEnd']);
    }

    /**
     * @param \Twig\Token $token
     *
     * @return bool
     */
    public function decideIfFork(Token $token): bool
    {
        return $token->test([
            static::TOKEN_ELSEWIDGET,
            static::TOKEN_NOWIDGET,
            static::TOKEN_ENDWIDGET,
        ]);
    }

    /**
     * @param \Twig\Token $token
     *
     * @return bool
     */
    public function decideIfEnd(Token $token): bool
    {
        return $token->test([static::TOKEN_ENDWIDGET]);
    }
}
