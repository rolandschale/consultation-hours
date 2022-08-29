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

namespace Comfortmedia\ContaoPraxisOpeningHours\Model;

use Contao\Model;

/**
 * Class OpeningHoursModel
 *
 * @package Comfortmedia\ContaoPraxisOpeningHours\Model
 */
class OpeningHoursModel extends Model
{
    protected static $strTable = 'tl_opening_hours';

}

