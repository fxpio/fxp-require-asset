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

use Fxp\Component\RequireAsset\Assetic\Config\FileExtensionInterface;
use Fxp\Component\RequireAsset\Assetic\Config\OutputManagerInterface;
use Fxp\Component\RequireAsset\Assetic\Config\PackageInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Assetic Resource Utils.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
abstract class ResourceUtils
{
    /**
     * Get the path relative.
     *
     * @param PackageInterface $package The asset package instance
     * @param SplFileInfo      $file    The Spo file info instance
     *
     * @return string
     */
    public static function getPathRelative(PackageInterface $package, SplFileInfo $file)
    {
        $fs = new Filesystem();
        $source = FilterUtils::fixRealPath($package->getSourcePath());

        return rtrim($fs->makePathRelative($file->getRealPath(), $source), '/');
    }

    /**
     * Get the assetic name of asset.
     *
     * @param PackageInterface $package The asset package instance
     * @param SplFileInfo      $file    The Spo file info instance
     *
     * @return string
     */
    public static function getPackageFilename(PackageInterface $package, SplFileInfo $file)
    {
        return $package->getName().'/'.static::getPathRelative($package, $file);
    }

    /**
     * Replace the file extension in output path.
     *
     * @param string                 $output The output path
     * @param FileExtensionInterface $ext    The config of file extension
     *
     * @return string
     */
    public static function replaceExtension($output, FileExtensionInterface $ext)
    {
        if (false !== $pos = strrpos($output, '.')) {
            $output = substr($output, 0, $pos).'.'.$ext->getOutputExtension();
        }

        return $output;
    }

    /**
     * Create the list of parameters for create the asset resource.
     *
     * @param PackageInterface       $package       The asset package instance
     * @param SplFileInfo            $file          The Spo file info instance
     * @param OutputManagerInterface $outputManager The output manager
     * @param bool                   $debug         The debug mode
     *
     * @return array The list of parameters: name, source link, output path, formulae filters, formulae options
     */
    public static function createConfigResource(PackageInterface $package, SplFileInfo $file, OutputManagerInterface $outputManager, $debug = false)
    {
        $name = static::getPackageFilename($package, $file);
        $output = static::getPathRelative($package, $file);
        $filters = [];
        $options = [];
        $ext = static::getSplFileExtension($file);
        $output = $package->getSourceBase().'/'.$output;

        if ($package->hasExtension($ext)) {
            $pExt = $package->getExtension($ext);
            $filters = static::cleanDebugFilters($pExt->getFilters(), $debug);
            $options = $pExt->getOptions();
            $output = static::replaceExtension($output, $pExt);
        }

        $output = $outputManager->convertOutput($output);

        return [$name, $file->getRealPath(), $output, $filters, $options];
    }

    /**
     * Remove filters should not be used in debug mode.
     *
     * @param array $filters The filters
     * @param bool  $debug   The debug mode
     *
     * @return array
     */
    public static function cleanDebugFilters(array $filters, $debug = false)
    {
        $news = [];

        foreach ($filters as $filter) {
            if (!$debug || ($debug && false === strpos($filter, '?'))) {
                $news[] = ltrim($filter, '?');
            }
        }

        return $news;
    }

    /**
     * Get the file extension of spl file.
     *
     * @param SplFileInfo $file
     *
     * @return string
     */
    protected static function getSplFileExtension(SplFileInfo $file)
    {
        return substr($file->getFilename(), (strrpos($file->getFilename(), '.') + 1));
    }
}
