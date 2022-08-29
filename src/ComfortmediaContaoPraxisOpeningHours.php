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

namespace Comfortmedia\ContaoPraxisOpeningHours;

use Comfortmedia\ContaoPraxisOpeningHours\DependencyInjection\ComfortmediaContaoPraxisOpeningHoursExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ComfortmediaContaoPraxisOpeningHours
 */
class ComfortmediaContaoPraxisOpeningHours extends Bundle
{
	public function getContainerExtension(): ComfortmediaContaoPraxisOpeningHoursExtension
	{
		return new ComfortmediaContaoPraxisOpeningHoursExtension();
	}

	/**
	 * {@inheritdoc}
	 */
	public function build(ContainerBuilder $container): void
	{
		parent::build($container);
		
	}
}
