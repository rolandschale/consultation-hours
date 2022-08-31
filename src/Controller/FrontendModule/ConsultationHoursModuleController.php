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
//         $userFirstname = 'DUDE';
//         $user = $this->get('security.helper')->getUser();
// 
//         // Get the logged in frontend user... if there is one
//         if ($user instanceof FrontendUser)
//         {
//             $userFirstname = $user->firstname;
//         }

        /** @var Session $session */
        // $session = $request->getSession();
        // $bag = $session->getBag('contao_frontend');
        // $bag->set('foo', 'bar');

        /** @var Date $dateAdapter */
//         $dateAdapter = $this->get('contao.framework')->getAdapter(Date::class);
// 
//         $intWeekday = $dateAdapter->parse('w');
//         $translator = $this->get('translator');
//         $strWeekday = $translator->trans('DAYS.' . $intWeekday, [], 'contao_default');

        $arrDays = [];

        // Get the database connection
        $db = $this->get('database_connection');

        /** @var \Doctrine\DBAL\Result $stmt */
        // $stmt = $db->executeQuery('SELECT * FROM tl_member WHERE gender = ? ORDER BY lastname', ['female']);
        $stmt = $db->executeQuery('SELECT * FROM tl_consultation_hours');

        while (false !== ($row = $stmt->fetchAssociative()))
        {
            $arrDays[] = $row['title'].$row['multitextField'];
            
        }
        $template->wrapperOpen = '<div class="ce_rsce_open_hours">';
        $template->consultationsTitle = printf(
            '<div class="headline">
                <h3><i class="fa-solid fa-clock"></i>&nbsp;&nbsp;Sprechzeiten</h3>
             </div>',
            $userFirstname, $strWeekday
        );

        $template->helloText = '';

        if (!empty($arrDays)){
            $template->helloText = $arrDays[0] . $arrDays[1] . $arrDays[2];
        }

        $template->wrapperClose = '</div>';

/* -----------------------------------
    Start
    
    
    
    <div class="ce_rsce_open_hours">
      <div class="headline">
        <h3><i class="fa-solid fa-clock"></i>&nbsp;&nbsp;Sprechzeiten</h3>
      </div>
      <div>
        <div class="row">
          <div class="day">Montag</div>
          <div class="time_am">
            <div class="time_from_am">08:00</div>
            <div class="time_to_am">bis 13:00 Uhr</div>
          </div>
          <div class="time_pm">
            <div class="time_from_pm">&nbsp;</div>
            <div class="time_to_pm">&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
 -----------------------------------*/
 
        //$template->headline = $this->get('title');
 
 
        return $template->getResponse();
    }
}
