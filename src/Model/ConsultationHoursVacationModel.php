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

namespace Rolandschale\ConsultationHoursBundle\Model;

use Contao\Model;

/**
 * Class ConsultationHoursModel
 *
 * @package Rolandschale\ConsultationHoursBundle\Model
 */
class ConsultationHoursModel extends Model
{
    protected static $strTable = 'tl_consultation_hours_vacation';

}

