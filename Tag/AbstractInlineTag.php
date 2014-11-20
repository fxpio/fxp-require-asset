<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Tag;

/**
 * Abstract inline template tag.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
abstract class AbstractInlineTag extends AbstractTag implements InlineTagInterface
{
    /**
     * @var string
     */
    protected $body;

    /**
     * Constructor.
     *
     * @param string      $body     The content body
     * @param string|null $position The position in the template
     * @param int         $lineno   The template lineno
     * @param string|null $filename The template filename
     */
    public function __construct($body, $position = null, $lineno = -1, $filename = null)
    {
        parent::__construct($position, $lineno, $filename);

        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return 'inline';
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }
}