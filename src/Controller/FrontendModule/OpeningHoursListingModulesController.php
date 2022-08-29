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

namespace Comfortmedia\ContaoPraxisOpeningHours\Controller\FrontendModule;

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
 * Class OpeningHoursListingModulesController
 *
 * @FrontendModule(OpeningHoursListingModulesController::TYPE, category="opening_hours_modules", template="mod_opening_hours_listing_modules")
 */
class OpeningHoursListingModulesController extends AbstractFrontendModuleController
{
    public const TYPE = 'opening_hours_listing_modules';

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
     * Generate the dummy module
     */
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        $userFirstname = 'DUDE';
        $user = $this->get('security.helper')->getUser();

        // Get the logged in frontend user... if there is one
        if ($user instanceof FrontendUser)
        {
            $userFirstname = $user->firstname;
        }

        /** @var Session $session */
        $session = $request->getSession();
        $bag = $session->getBag('contao_frontend');
        $bag->set('foo', 'bar');

        /** @var Date $dateAdapter */
        $dateAdapter = $this->get('contao.framework')->getAdapter(Date::class);

        $intWeekday = $dateAdapter->parse('w');
        $translator = $this->get('translator');
        $strWeekday = $translator->trans('DAYS.' . $intWeekday, [], 'contao_default');

        $arrGuests = [];

        // Get the database connection
        $db = $this->get('database_connection');

        /** @var \Doctrine\DBAL\Result $stmt */
        $stmt = $db->executeQuery('SELECT * FROM tl_member WHERE gender = ? ORDER BY lastname', ['female']);

        while (false !== ($row = $stmt->fetchAssociative()))
        {
            $arrGuests[] = $row['firstname'];
        }

        $template->helloTitle = sprintf(
            'Hi %s, and welcome to the "Hello World Module". Today is %s.',
            $userFirstname, $strWeekday
        );

        $template->helloText = '';

        if (!empty($arrGuests)){
            $template->helloText = 'Our guests today are: ' . implode(', ', $arrGuests);
        }

        return $template->getResponse();
    }
}
