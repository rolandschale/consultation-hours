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

namespace Rolandschale\ConsultationHoursBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\Date;
use Contao\FrontendUser;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\Template;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class ConsultationHoursModuleController
 *
 * @FrontendModule(ConsultationHoursModuleController::TYPE, category="consultation_hours_modules", template="mod_consultation_hours_module")
 */
class ConsultationHoursModuleController extends AbstractFrontendModuleController
{
    public const TYPE = 'consultation_hours_module';

    /**
     * @var PageModel
     */
    protected $page;

    /**
     * This method extends the parent __invoke method,
     * its usage is usually not necessary
     */
    public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response
    {
        // Get the page model
        $this->page = $page;

        $scopeMatcher = $this->get('contao.routing.scope_matcher');

        if ($this->page instanceof PageModel && $scopeMatcher->isFrontendRequest($request))
        {
            // If TL_MODE === 'FE'
            $this->page->loadDetails();
        }

        return parent::__invoke($request, $model, $section, $classes);
    }

    /**
     * Lazyload services
     */
    public static function getSubscribedServices(): array
    {
        $services = parent::getSubscribedServices();

        $services['contao.framework'] = ContaoFramework::class;
        $services['database_connection'] = Connection::class;
        $services['contao.routing.scope_matcher'] = ScopeMatcher::class;
        $services['security.helper'] = Security::class;
        $services['translator'] = TranslatorInterface::class;

        return $services;
    }

    /**
     * Generate the module
     */
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {


        $arrDays = [];
        $arrDump = [];
        
        // Get the database connection
        $db = $this->get('database_connection');

        /** @var \Doctrine\DBAL\Result $stmt */
        $stmt = $db->executeQuery('SELECT * FROM tl_consultation_hours');

        $template->consultationsTitle = 'Sprechzeiten';

        while (false !== ($row = $stmt->fetchAssociative()))
        {
            $string[] = unserialize($row['multitextField']);
            
            $arrDays[] = '<div class="row">';
            $arrDays[] = '<div class="day">' . $row['title'] . '</div>';
            $arrDays[] = '<div class="time_am">';
            $arrDays[] = '<div class="time_from_am">' . $string[0] . ' Uhr</div>';
            $arrDays[] = '<div class="time_to_am">bis ' . $string[1]  . ' Uhr</div>';
            $arrDays[] = '</div>';
            $arrDays[] = '<div class="time_pm">';
            $arrDays[] = '<div class="time_from_pm">' . $string[2] . '</div>';
            $arrDays[] = '<div class="time_to_pm">' . $string[3] . '</div>';
            $arrDays[] = '</div>';            
            $arrDays[] = '</div>';     
            //$arrDump[] = '##1##' . $row['multitextField'];       
            //$arrDump[] = '##2##' . unserialize($row['multitextField']);           
        }

        $template->consultationsRow = '';

        if (!empty($arrDays)){
            $template->consultationsRow = implode($arrDays);
        }

        if (!empty($arrDump)){
            //$template->dump = $arrDump;
        }        

 
 
        return $template->getResponse();
    }
}
