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

namespace Rolandschale\ConsultationHoursBundle;

use Rolandschale\ConsultationHoursBundle\DependencyInjection\RolandschaleConsultationHoursExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class RolandschaleConsultationHoursBundle
 */
class RolandschaleConsultationHoursBundle extends Bundle
{
	public function getContainerExtension(): RolandschaleConsultationHoursExtension
	{
		return new RolandschaleConsultationHoursExtension();
	}

	/**
	 * {@inheritdoc}
	 */
	public function build(ContainerBuilder $container): void
	{
		parent::build($container);
		
	}
}
