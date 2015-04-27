<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Theme;
use Illuminate\Support\Facades\File;

class Carousel extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Bootstrap Carousel',
            'description' => 'Photos player'
        ];
    }

    public function defineProperties()
    {
        return [

            'photos_folder' => [
                'title' => 'Photos folder',
                'description' => 'Folder where the images to display are stored',
                'type' => 'string'
            ],
            'sliders' => [
                'title' => 'Show sliders',
                'description' => 'Add previous and next navigation buttons over the player',
                'type' => 'checkbox',
                'default' => true
            ],
            'indicators' => [
                'title' => 'Show indicators',
                'description' => 'Add small navigation buttons at the bottom of the player',
                'type' => 'checkbox',
                'default' => false
            ]
        ];
    }

    public function getOptions()
    {
        return $this->getProperties();
    }

    public function getPhotosList()
    {
        $theme = Theme::getEditTheme()->getDirName();
        $folderPath = $this->property('photos_folder');
        $directoryPath = "themes/" . $theme . "/assets/" . $folderPath;

        $photos = null;
        if (File::exists($directoryPath))
        {
            $photos = File::files($directoryPath);
        }

        return $photos;
    }

    public function onRun()
    {
        
    }

}
