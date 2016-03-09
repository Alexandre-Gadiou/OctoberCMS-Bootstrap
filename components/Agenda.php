<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Algad\Bootstrap\Models\Event;

class Agenda extends ComponentBase
{

    public $eventList;
    public $eventListJS;

    public function componentDetails()
    {
        return [
            'name' => 'algad.bootstrap::lang.agenda.name',
            'description' => 'algad.bootstrap::lang.agenda.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'width' => [
                'title' => 'algad.bootstrap::lang.agenda.width.name',
                'type' => 'string',
                'default' => '500px',
            ],
            'view' => [
                'title' => 'algad.bootstrap::lang.agenda.view.name',
                'default' => 'default',
                'type' => 'dropdown',
                'options' => [
                    'default' => 'algad.bootstrap::lang.agenda.view.option.default',
                ],
            ]
        ];
    }

    public function getProperty($propertyName)
    {
        return $this->property($propertyName);
    }

    public function onRender()
    {
        return $this->renderPartial('@' . $this->property('view'));
    }

    public function onRun()
    {
        $this->eventList = Event::orderBy('date', 'asc')->get();
        $this->addJs('/plugins/algad/bootstrap/assets/vendor/bootstrap-agenda/js/responsive-calendar.min.js');
        $this->addCss('/plugins/algad/bootstrap/assets/vendor/bootstrap-agenda/css/responsive-calendar.css');

        $i = 0;
        $len = count($this->eventList);
        foreach ($this->eventList as $event)
        {
            $this->eventListJS = $this->eventListJS . '"' . date("Y-m-d", strtotime($event['date'])) . '"' . ": {}";
            if ($i != $len - 1)
            {
                $this->eventListJS = $this->eventListJS . ",";
            }
            $i++;
        }
    }

}
