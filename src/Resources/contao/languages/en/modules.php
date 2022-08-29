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

use Comfortmedia\ContaoPraxisOpeningHours\Controller\FrontendModule\OpeningHoursListingModulesController;

/**
 * Backend modules
 */
$GLOBALS['TL_LANG']['MOD']['opening_hours_modules'] = 'Öffnungszeiten';
$GLOBALS['TL_LANG']['MOD']['opening_hours_collection'] = ['Öffnungszeiten', 'Erfassen der Öffnungszeiten'];

/**
 * Frontend modules
 */
$GLOBALS['TL_LANG']['FMD'][OpeningHoursListingModulesController::TYPE] = ['Öffnungszeiten', 'Ausgabe der Öffnungszeiten'];

