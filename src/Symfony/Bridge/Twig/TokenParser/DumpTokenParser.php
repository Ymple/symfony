<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Twig\TokenParser;

use Symfony\Bridge\Twig\Node\DumpNode;

/**
 * Token Parser for the 'dump' tag.
 *
 * Dump variables with:
 * <pre>
 *  {% dump %}
 *  {% dump foo %}
 *  {% dump foo, bar %}
 * </pre>
 *
 * @author Julien Galenski <julien.galenski@gmail.com>
 */
class DumpTokenParser extends \Twig_TokenParser
{
    /**
     * {@inheritdoc}
     */
    public function parse(\Twig_Token $token)
    {
        $values = null;
        if (!$this->parser->getStream()->test(\Twig_Token::BLOCK_END_TYPE)) {
            $values = $this->parser->getExpressionParser()->parseMultitargetExpression();
        }
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new DumpNode($values, $token->getLine(), $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'dump';
    }
}
