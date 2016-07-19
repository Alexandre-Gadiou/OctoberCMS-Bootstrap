<?php

namespace Algad\Bootstrap;

use System\Classes\PluginBase;
use \RainLab\Translate\Classes\Translator;
use Event;
use Lang;
use Algad\Bootstrap\Helpers\StringUtils;

/**
 * Algad Bootstrap Plugin Information File.
 */
class Plugin extends PluginBase
{

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

                'trans' => function($key, $bundle)
                {
                    $result = Lang::get($bundle . '::lang.' . $key, [], Translator::instance()->getLocale());
                    if (StringUtils::instance()->startsWith($result, $bundle))
                    {
                        return $key;
                    }
                    else
                    {
                        return $result;
                    }
                },
                        'config' => function($key)
                {
                    return config($key);
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
                    'Algad\Bootstrap\Components\ScrollTop' => 'scrolltop',
                    'Algad\Bootstrap\Components\Agenda' => 'agenda',
                ];
            }

            public function registerMailTemplates()
            {
                return [
                    'algad.bootstrap::mail.contactform.message' => 'Contact form email template'
                ];
            }

        }
        