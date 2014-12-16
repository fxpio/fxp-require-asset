<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Assetic\Util;

use Fxp\Component\RequireAsset\Assetic\RequireLocaleManagerInterface;

/**
 * Assetic Locale Utils.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
abstract class LocaleUtils
{
    /**
     * Format the locale common name.
     *
     * @param string $name   The common asset name
     * @param string $locale The locale
     *
     * @return string
     */
    public static function formatLocaleCommonName($name, $locale)
    {
        return $name.'__'.strtolower($locale);
    }

    /**
     * Get the locale common inputs.
     *
     * @param array                         $inputs        The formulae inputs
     * @param string                        $locale        The locale
     * @param RequireLocaleManagerInterface $localeManager The locale manager
     *
     * @return string[]
     */
    public static function getLocaleCommonInputs(array $inputs, $locale, RequireLocaleManagerInterface $localeManager)
    {
        $localeInputs = array();

        foreach ($inputs as $input) {
            $localeInputs = array_merge($localeInputs, $localeManager->getLocalizedAsset($input, $locale));
        }

        return $localeInputs;
    }

    /**
     * Convert the target path to the locale target path.
     *
     * @param string $targetPath The require target path
     * @param string $locale     The locale
     *
     * @return string
     */
    public static function convertLocaleTartgetPath($targetPath, $locale)
    {
        $pos = strrpos($targetPath, '.');

        if (false !== $pos) {
            $a = substr($targetPath, 0, $pos);
            $b = substr($targetPath, $pos);
            $targetPath = $a.'-'.str_replace('_', '-', strtolower($locale)).$b;
        }

        return $targetPath;
    }

    /**
     * Finds the locales of common asset.
     *
     * @param array                         $inputs        The formulae inputs
     * @param RequireLocaleManagerInterface $localeManager The locale manager
     *
     * @return string[]
     */
    public static function findCommonAssetLocales(array $inputs, RequireLocaleManagerInterface $localeManager)
    {
        $locales = array();

        foreach ($inputs as $input) {
            $locales = array_merge($locales, $localeManager->getAssetLocales($input));
        }

        return array_unique($locales);
    }
}