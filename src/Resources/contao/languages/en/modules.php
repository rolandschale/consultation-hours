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

use Rolandschale\ConsultationHoursBundle\Controller\FrontendModule\ConsultationHoursModuleController;

/**
 * Backend modules
 */
$GLOBALS['TL_LANG']['MOD']['consultation_hours_modules'] = 'Stammdaten';
$GLOBALS['TL_LANG']['MOD']['consultation_hours_collection'] = ['Sprechzeiten', 'Bearbeiten der Sprechzeiten'];

/**
 * Frontend modules
 */
$GLOBALS['TL_LANG']['FMD']['consultation_hours_modules'] = 'Sprechzeiten Modul';
$GLOBALS['TL_LANG']['FMD'][ConsultationHoursModuleController::TYPE] = ['Sprechzeiten', 'Sprechzeiten'];

