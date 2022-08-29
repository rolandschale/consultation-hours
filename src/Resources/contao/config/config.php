<?php

/*
 * This file is part of Praxis Öffnungszeiten.
 * 
 * (c) Roland Schale 2022 <schale@comfortmedia.com>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/comfortmedia/contao-praxis-opening-hours
 */

use Comfortmedia\ContaoPraxisOpeningHours\Model\OpeningHoursModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['opening_hours_modules']['opening_hours_collection'] = array(
    'tables' => array('tl_opening_hours')
);

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_opening_hours'] = OpeningHoursModel::class;
