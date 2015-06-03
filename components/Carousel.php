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
            'name' => 'Carousel',
            'description' => 'Photos player'
        ];
    }

    public function defineProperties()
    {
        return [

            'photos_folder' => [
                'title' => 'Photos folder',
                'description' => 'Folder where the images to display are stored',
                'default' => 'storage/app/media',
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
            ],
            'height' => [
                'title' => 'Height',
                'type' => 'string',
                'default' => '500px'
            ],
            'borderRadius' => [
                'title' => 'Border radius',
                'type' => 'string',
                'default' => '10px'
            ]
        ];
    }

    public function getOptions()
    {
        return $this->getProperties();
    }

    public function getPhotosList()
    {
        $photos = null;
        $folderPath = $this->property('photos_folder');
        if (File::exists($folderPath))
        {
            $photos = File::files($folderPath);
        }

        return $photos;
    }

}
