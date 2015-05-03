<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;

class ContactForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Bootstrap Contact Form',
            'description' => 'Contact form'
        ];
    }

    public function defineProperties()
    {
        return [

            'recipient_email' => [
                'title' => 'Recipient Email',
                'description' => 'Email address where emails are sent to',
                'type' => 'string'
            ]
        ];
    }

    public function getOptions()
    {
        return $this->getProperties();
    }

}
