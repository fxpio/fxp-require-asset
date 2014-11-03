<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Assetic\Config;

use Fxp\Component\RequireAsset\Assetic\Factory\Config\FileExtensionFactory;
use Fxp\Component\RequireAsset\Exception\BadMethodCallException;
use Fxp\Component\RequireAsset\Exception\InvalidConfigurationException;

/**
 * Config file extension manager.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class FileExtensionManager extends AbstractConfigManager implements FileExtensionManagerInterface
{
    /**
     * @var array
     */
    protected $defaults;

    /**
     * @var array
     */
    protected $unresolvedDefaults;

    /**
     * @var bool
     */
    protected $locked;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->defaults = array();
        $this->unresolvedDefaults = array();
        $this->locked = false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDefaultExtension($name)
    {
        return isset($this->defaults[$name]) || isset($this->unresolvedDefaults[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function addDefaultExtension($name, array $options = array(), array $filters = array(), $extension = null, $debug = false, $exclude = false)
    {
        return $this->doAdd('Fxp\Component\RequireAsset\Assetic\Util\FileExtensionUtils', 'unresolvedDefaults', array($name, $options, $filters, $extension, $debug, $exclude));
    }

    /**
     * {@inheritdoc}
     */
    public function addDefaultExtensions(array $configs)
    {
        return $this->addConfig($configs, 'addDefaultExtension');
    }

    /**
     * {@inheritdoc}
     */
    public function removeDefaultExtension($name)
    {
        $this->validate();
        unset($this->unresolvedDefaults[$name]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultExtension($name)
    {
        $this->resolve();

        if (!$this->hasDefaultExtension($name)) {
            throw new InvalidConfigurationException(sprintf('The "%s" default file extension does not exist', $name));
        }

        return $this->defaults[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultExtensions()
    {
        $this->resolve();

        return $this->defaults;
    }

    /**
     * Resolves the configuration.
     */
    protected function resolve()
    {
        $this->locked = true;

        /* @var FileExtensionInterface[] $configs */
        foreach ($this->unresolvedDefaults as $configs) {
            $ext = FileExtensionFactory::merge($configs);
            $this->defaults[$ext->getName()] = $ext;
        }

        $this->unresolvedDefaults = array();
    }

    /**
     * {@inheritdoc}
     */
    protected function validate()
    {
        if ($this->locked) {
            throw new BadMethodCallException('FileExtensionManager methods cannot be accessed when the manager is locked');
        }
    }
}
