<?php

namespace Algad\Bootstrap;

use System\Classes\PluginBase;
use \RainLab\Translate\Classes\Translator;
use Event;
use Lang;

/**
 * Algad Bootstrap Plugin Information File.
 */
class Plugin extends PluginBase
{

    /**
     * Algad Bootstrap plugin information.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'algad.bootstrap::lang.plugin.name',
            'description' => 'algad.bootstrap::lang.plugin.description',
            'author' => 'Alexander GADIOU',
            'homepage' => 'http://alexandre-gadiou.appspot.com',
            'icon' => 'icon-flask'
        ];
    }

    /**
     * Add a tab 'Menu' in page settings
     *
     */
    public function register()
    {
        Event::listen('backend.form.extendFields', function($widget)
        {
            if (!$widget->model instanceof \Cms\Classes\Page)
                return;

            $widget->addFields([
                'settings[menu_text]' => [
                    'label' => 'Displayed text',
                    'tab' => 'Menu',
                    'span' => 'left',
                ],
                'settings[menu_order]' => [
                    'label' => 'Order',
                    'comment' => 'Change the order of displayed items',
                    'tab' => 'Menu',
                    'span' => 'right',
                ],
                    ], 'primary');
        });
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [

                'trans' => function($key)
                {
                    return Lang::get('algad.bootstrap::lang.' . $key, [], Translator::instance()->getLocale());
                }
                    ]
                ];
            }

            public function registerComponents()
            {
                return [
                    'Algad\Bootstrap\Components\Carousel' => 'carousel',
                    'Algad\Bootstrap\Components\Menu' => 'menu',
                    'Algad\Bootstrap\Components\ContactForm' => 'contactform',
                ];
            }

            public function registerMailTemplates()
            {
                return [
                    'algad.bootstrap::mail.contactform.message' => 'Contact form email template'
                ];
            }

        }
        