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

use Rolandschale\ConsultationHoursBundle\Model\ConsultationHoursModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['consultation_hours_modules']['consultation_hours_collection'] = array(
    'tables' => array('tl_consultation_hours')
);
$GLOBALS['BE_MOD']['consultation_hours_modules']['consultation_hours_vacation'] = array(
    'tables' => array('tl_consultation_hours_vacation')
);
$GLOBALS['BE_MOD']['consultation_hours_modules']['consultation_hours_address'] = array(
    'tables' => array('tl_consultation_hours_address')
);

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_consultation_hours'] = ConsultationHoursModel::class;
