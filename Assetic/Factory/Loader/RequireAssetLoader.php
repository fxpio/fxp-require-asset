<?php

/*
 * This file is part of the Fxp RequireAssetBundle package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Bundle\RequireAssetBundle\Assetic\Factory\Loader;

use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\ResourceInterface;
use Fxp\Bundle\RequireAssetBundle\Assetic\Factory\Resource\RequireAssetResource;

/**
 * Creates formulaes for require asset resources.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class RequireAssetLoader implements FormulaLoaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ResourceInterface $resource)
    {
        return $resource instanceof RequireAssetResource ? $resource->getContent() : array();
    }
}