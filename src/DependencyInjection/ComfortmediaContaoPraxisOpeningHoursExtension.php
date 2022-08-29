<?php

declare(strict_types=1);

/*
 * This file is part of Praxis Öffnungszeiten.
 * 
 * (c) Roland Schale 2022 <schale@comfortmedia.com>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/comfortmedia/contao-praxis-opening-hours
 */

namespace Comfortmedia\ContaoPraxisOpeningHours\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Comfortmedia\ContaoPraxisOpeningHours\DependencyInjection\Configuration;

/**
 * Class ComfortmediaContaoPraxisOpeningHoursExtension
 */
class ComfortmediaContaoPraxisOpeningHoursExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return Configuration::ROOT_KEY;
    }

    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('parameters.yml');
        $loader->load('services.yml');
        $loader->load('listener.yml');


        $rootKey = $this->getAlias();

        $container->setParameter($rootKey.'.foo.bar', $config['foo']['bar']);
    }
}
