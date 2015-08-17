<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;

class ScrollTop extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Scroll Top',
            'description' => 'Scroll top button'
        ];
    }

    public function getProperty($propertyName)
    {
        return $this->property($propertyName);
    }

    public function onRun()
    {
        $this->addCss('/plugins/algad/bootstrap/components/assets/css/scrollTop.css');
    }

}
