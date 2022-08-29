<?php

/*
 * This file is part of Sprechstunden Bundle.
 * 
 * (c) Roland Schale 2022 <roland.schale@gmail.com>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/rolandschale/consultation-hours-bundle
 */
declare(strict_types=1);

namespace Rolandschale\ConsultationHoursBundle\Tests\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\DelegatingParser;
use Contao\TestCase\ContaoTestCase;
use Rolandschale\ConsultationHoursBundle\ContaoManager\Plugin;
use Rolandschale\ConsultationHoursBundle\RolandschaleConsultationHoursBundle;

/**
 * Class PluginTest
 *
 * @package Rolandschale\ConsultationHoursBundle\Tests\ContaoManager
 */
class PluginTest extends ContaoTestCase
{
    /**
     * Test Contao manager plugin class instantiation
     */
    public function testInstantiation(): void
    {
        $this->assertInstanceOf(Plugin::class, new Plugin());
    }

    /**
     * Test returns the bundles
     */
    public function testGetBundles(): void
    {
        $plugin = new Plugin();

        /** @var array $bundles */
        $bundles = $plugin->getBundles(new DelegatingParser());

        $this->assertCount(1, $bundles);
        $this->assertInstanceOf(BundleConfig::class, $bundles[0]);
        $this->assertSame(RolandschaleConsultationHoursBundle::class, $bundles[0]->getName());
        $this->assertSame([ContaoCoreBundle::class], $bundles[0]->getLoadAfter());
    }

}
