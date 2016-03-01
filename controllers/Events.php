<?php namespace Algad\Bootstrap\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Events extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'algad.bootstrap.manage.events' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Algad.Bootstrap', 'Calendar', 'events');
    }
}