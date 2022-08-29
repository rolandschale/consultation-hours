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

namespace Comfortmedia\ContaoPraxisOpeningHours\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HeroimageElementController
 *
 * @ContentElement(HeroimageElementController::TYPE, category="image_elements", template="ce_heroimage_element")
 */
class HeroimageElementController extends AbstractContentElementController
{
    public const TYPE = 'heroimage_element';

    /**
     * Generate the content element
     */
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $template->text = $model->text;

        return $template->getResponse();
    }
}
