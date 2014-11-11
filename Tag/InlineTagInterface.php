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
 * Interface of inline template tag.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
interface InlineTagInterface extends TagInterface
{
    /**
     * Get the content body.
     *
     * @return string
     */
    public function getBody();
}
