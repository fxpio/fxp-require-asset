<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Tag\Renderer;

use Fxp\Component\RequireAsset\Asset\Config\LocaleManagerInterface;

/**
 * Abstract template require tag renderer.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
abstract class BaseRequireTagRenderer implements RequireTagRendererInterface
{
    /**
     * The list of already rendered tags.
     *
     * @var array
     */
    protected $renderedTags;

    /**
     * @var null|LocaleManagerInterface
     */
    protected $localeManager;

    /**
     * Constructor.
     *
     * @param null|LocaleManagerInterface $localeManager The require locale asset manager
     */
    public function __construct(LocaleManagerInterface $localeManager = null)
    {
        $this->localeManager = $localeManager;
        $this->reset();
    }

    /**
     * {@inheritdoc}
     */
    public function reset(): void
    {
        $this->renderedTags = [];
    }

    /**
     * Get localized assets.
     *
     * @param string $asset The require asset
     *
     * @return string[]
     */
    protected function getLocalizedAssets($asset)
    {
        if (null !== $this->localeManager) {
            return $this->localeManager->getLocalizedAsset($asset);
        }

        return [];
    }

    /**
     * Check if the asset can be rendered.
     *
     * @param string $assetName The asset name
     * @param string $type      The require tag type
     *
     * @return bool
     */
    protected function canBeRendered($assetName, $type)
    {
        return !\in_array($type.'::'.$assetName, $this->renderedTags, true);
    }
}
