<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use System\Classes\ApplicationException;

class Menu extends ComponentBase
{

    public $links = [];

    public function componentDetails()
    {
        return [
            'name' => 'Menu',
            'description' => 'Navigation bar'
        ];
    }

    public function defineProperties()
    {
        return [
            'nav_brand' => [
                'title' => 'Brand',
                'description' => 'Choose brand name',
                'type' => 'string',
            ],
            'nav_type' => [
                'title' => 'Type',
                'description' => 'Navbar type',
                'type' => 'dropdown',
                'default' => 'navbar-default',
                'placeholder' => 'Select',
                'options' => ['blank' => 'blank', 'navbar-default' => 'navbar-default', 'navbar-inverse' => 'navbar-inverse']
            ],
            'nav_position' => [
                'title' => 'Position',
                'description' => 'Navbar position values :  navbar-fixed-top, navbar-static-top, your-custom-css-class ... ',
                'type' => 'string',
                'default' => '',
            ],
            'nav_container_css' => [
                'title' => 'Container',
                'description' => 'Choose css for nav container',
                'type' => 'string',
                'default' => 'container'
            ],
            'main_ul_class' => [
                'title' => 'Menu class',
                'description' => 'The class attribute for the main menu (ul).',
                'type' => 'string',
                'default' => 'nav navbar-nav'
            ],
            'li_parent_class' => [
                'title' => 'li submenu class',
                'description' => 'The class attribute for the sub menu (li).',
                'type' => 'string',
                'default' => 'dropdown'
            ],
            'sub_ul_class' => [
                'title' => 'ul submenu class',
                'description' => 'The class attribute for the sub menu (ul).',
                'type' => 'string',
                'default' => 'dropdown-menu'
            ],
            'main_li_class' => [
                'title' => 'Item class',
                'description' => 'The class attribute for the menu items (li).',
                'type' => 'string',
                'default' => ''
            ],
            'active_class' => [
                'title' => 'Active class',
                'description' => 'The class attribute for the active item.',
                'type' => 'string',
                'default' => 'active'
            ]
        ];
    }

    public function getOptions()
    {
        return array_merge(
                $this->getProperties(), [
            'currentURL' => \URL::current(),
            'links' => static::parsePages(static::listPages())
        ]);
    }

    private static function listPages()
    {
        if (!($theme = Theme::getEditTheme()))
            throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));

        $pages = Page::listInTheme($theme, true);

        $result = [];
        foreach ($pages as $page)
        {
            $page->addVisible('menu_text');
            $page->addVisible('menu_order');
            if ($page->not_show_menu != "1" && !empty($page->menu_order))
            {
                $result[$page->menu_order] = [
                    'text' => $page->menu_text != '' ? $page->menu_text : $page->title,
                    'path' => $page->getBaseFileName(),
                    'order' => $page->menu_order != '' ? $page->menu_order : 1
                ];
            }
        }

        ksort($result);

        return $result;
    }

    private static function parsePages($pages = [])
    {
        $tree = [];
        foreach ($pages as $page)
        {
            array_set($tree, str_replace('/', '.', $page['path']), $page);
        }
        return $tree;
    }

}
