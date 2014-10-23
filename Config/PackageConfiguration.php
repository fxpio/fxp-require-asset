<?php

/*
 * This file is part of the Fxp RequireAssetBundle package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Config;

/**
 * This is the class that validates and merges configuration for pattern.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class PackageConfiguration extends AbstractConfiguration
{
    /**
     * {@inheritdoc}
     */
    public static function getConfigNode($treeBuilder = null)
    {
        $node = static::createRoot('packages', $treeBuilder)
            ->useAttributeAsKey('name', false)
            ->normalizeKeys(false)
            ->prototype('array')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('name')->end()
                    ->scalarNode('source_path')->defaultNull()->end()
                    ->scalarNode('source_base')->defaultNull()->end()
                    ->booleanNode('replace_default_extensions')->defaultFalse()->end()
                    ->booleanNode('replace_default_patterns')->defaultFalse()->end()
                    ->append(FileExtensionConfiguration::getConfigNode())
                    ->append(PatternConfiguration::getConfigNode())
                ->end()
            ->end()
        ;

        return $node;
    }
}