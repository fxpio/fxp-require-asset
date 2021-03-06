<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Asset\Config;

/**
 * Interface of require locale asset manager.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
interface LocaleManagerInterface
{
    /**
     * Set the locale.
     *
     * @param string $locale
     *
     * @return self
     */
    public function setLocale($locale);

    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set the fallback locale.
     *
     * @param string $locale
     *
     * @return self
     */
    public function setFallbackLocale($locale);

    /**
     * Get the fallback locale.
     *
     * @return string
     */
    public function getFallbackLocale();

    /**
     * Check if the require localized asset exist.
     *
     * @param string      $asset  The require asset
     * @param null|string $locale The locale
     *
     * @return bool
     */
    public function hasLocalizedAsset($asset, $locale = null);

    /**
     * Add the require localized asset.
     *
     * @param string          $asset          The require asset
     * @param string          $locale         The locale
     * @param string|string[] $localizedAsset The require localized assets
     *
     * @return self
     */
    public function addLocalizedAsset($asset, $locale, $localizedAsset);

    /**
     * Remove the require localized asset.
     *
     * @param string $asset  The require asset
     * @param string $locale The locale
     *
     * @return self
     */
    public function removeLocalizedAsset($asset, $locale);

    /**
     * Get the require localized asset.
     *
     * @param string      $asset  The require asset
     * @param null|string $locale The locale
     *
     * @return string[] Return the require localized assets
     */
    public function getLocalizedAsset($asset, $locale = null);

    /**
     * Get the require localized assets.
     *
     * @return array Return the map of locale and localized assets
     */
    public function getLocalizedAssets();

    /**
     * Check if the locale exists.
     *
     * @param string $locale
     *
     * @return bool
     */
    public function hasAssetLocale($locale);

    /**
     * Get existing locale for all asset or a specific asset.
     *
     * @param null|string $asset The require asset
     *
     * @return string[]
     */
    public function getAssetLocales($asset = null);
}
