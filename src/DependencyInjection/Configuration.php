<?php

declare(strict_types=1);

/*
 * This file is part of Sprechstunden Bundle.
 * 
 * (c) Roland Schale 2022 <roland.schale@gmail.com>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/rolandschale/consultation-hours-bundle
 */

namespace Rolandschale\ConsultationHoursBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const ROOT_KEY = 'rolandschale_consultation_hours';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ROOT_KEY);

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('foo')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('bar')
                            ->cannotBeEmpty()
                            ->defaultValue('***')
                        ->end()
                    ->end()
                ->end() // end foo
            ->end()
        ;

        return $treeBuilder;
    }
}
