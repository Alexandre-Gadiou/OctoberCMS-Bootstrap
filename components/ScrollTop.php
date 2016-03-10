<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;

class ScrollTop extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'algad.bootstrap::lang.scrollTop.name',
            'description' => 'algad.bootstrap::lang.scrollTop.description'
        ];
    }

    public function getProperty($propertyName)
    {
        return $this->property($propertyName);
    }

    public function onRun()
    {
        $this->addCss('/plugins/algad/bootstrap/assets/css/scrollTop.css');
    }

}
