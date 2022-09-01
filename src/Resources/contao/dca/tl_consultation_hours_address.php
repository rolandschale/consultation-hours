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

use Contao\Backend;
use Contao\DC_Table;
use Contao\Input;

/**
 * Table tl_consultation_hours_address
 */
$GLOBALS['TL_DCA']['tl_consultation_hours_address'] = array(

    // Config
    'config'      => array(
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql'              => array(
            'keys' => array(
                'id' => 'primary'
            )
        ),
    ),
    'edit'        => array(
        'buttons_callback' => array(
            array('tl_consultation_hours_address', 'buttonsCallback')
        )
    ),
    'list'        => array(
        'sorting'           => array(
            'mode'        => 0,
            'fields'      => array('id'),
            'flag'        => 11,
            'panelLayout' => ''
        ),
        'label'             => array(
            'fields' => array('name_1'),
            'format' => '%s',
        ),
        'global_operations' => array(
            'all' => array(
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array(
            'edit'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_consultation_hours_address']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg'
            ),
            // 'copy'   => array(
            //     'label' => &$GLOBALS['TL_LANG']['tl_consultation_hours_address']['copy'],
            //     'href'  => 'act=copy',
            //     'icon'  => 'copy.svg'
            // ),
            // 'delete' => array(
            //     'label'      => &$GLOBALS['TL_LANG']['tl_consultation_hours_address']['delete'],
            //     'href'       => 'act=delete',
            //     'icon'       => 'delete.svg',
            //     'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            // ),
            'show'   => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_consultation_hours_address']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ),
        )
    ),
    // Palettes
    'palettes'    => array(
        'default'      => '{first_legend},name_1,name_2,name_3,street,zip,city;{second_legend},phone_1,phone_2,e_mail}'
    ),

    // Fields
    'fields'      => array(
        'id'             => array(
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'         => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'name_1'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'name_2'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'name_3'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'street'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'zip'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 5, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'city'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

        'phone_1'  => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => array('rgxp' => 'phone','mandatory' => false, 'maxlength' => 20, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'phone_2'  => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => array('rgxp' => 'phone','mandatory' => false, 'maxlength' => 20, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'mail_1'  => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => array('rgxp' => 'mail','mandatory' => false, 'maxlength' => 50, 'tl_class' => 'w100'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),

    )
);

/**
 * Class tl_consultation_hours_address
 */
class tl_consultation_hours_address extends Backend
{
    /**
     * @param $arrButtons
     * @param  DC_Table $dc
     * @return mixed
     */
    public function buttonsCallback($arrButtons, DC_Table $dc)
    {
        if (Input::get('act') === 'edit')
        {
            $arrButtons['customButton'] = '<button type="submit" name="customButton" id="customButton" class="tl_submit customButton" accesskey="x">' . $GLOBALS['TL_LANG']['tl_consultation_hours_address']['customButton'] . '</button>';
        }

        return $arrButtons;
    }
}
