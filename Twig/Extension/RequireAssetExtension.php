<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Twig\Extension;

use Fxp\Component\RequireAsset\Asset\RequireAssetManagerInterface;

/**
 * RequireAssetExtension extends Twig with global assets rendering capabilities.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class RequireAssetExtension extends \Twig_Extension
{
    /**
     * @var RequireAssetManagerInterface|null
     */
    protected $manager;

    /**
     * Constructor.
     *
     * @param RequireAssetManagerInterface|null $manager The require asset manager
     */
    public function __construct(RequireAssetManagerInterface $manager = null)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('requireAsset', array($this, 'requireAsset')),
        );
    }

    /**
     * Get the target path of the require asset.
     *
     * @param string $asset The require asset name
     *
     * @return string
     */
    public function requireAsset($asset)
    {
        return null !== $this->manager && $this->manager->has($asset)
            ? $this->manager->getPath($asset)
            : $asset;
    }
}
