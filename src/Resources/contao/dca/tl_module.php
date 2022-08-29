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
 * Frontend modules
 */
$GLOBALS['TL_DCA']['tl_module']['palettes'][OpeningHoursListingModulesController::TYPE] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
