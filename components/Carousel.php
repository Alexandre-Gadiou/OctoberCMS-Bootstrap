<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\File;

class Carousel extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'algad.bootstrap::lang.carousel.name',
            'description' => 'algad.bootstrap::lang.carousel.description'
        ];
    }

    public function defineProperties()
    {
        return [

            'photos_folder' => [
                'title' => 'algad.bootstrap::lang.carousel.photos_folder.name',
                'description' => 'algad.bootstrap::lang.carousel.photos_folder.tooltip',
                'default' => 'storage/app/media',
                'type' => 'string'
            ],
            'sliders' => [
                'title' => 'algad.bootstrap::lang.carousel.sliders.name',
                'description' => 'algad.bootstrap::lang.carousel.sliders.tooltip',
                'type' => 'checkbox',
                'default' => true
            ],
            'indicators' => [
                'title' => 'algad.bootstrap::lang.carousel.indicators.name',
                'description' => 'algad.bootstrap::lang.carousel.indicators.tooltip',
                'type' => 'checkbox',
                'default' => false
            ],
            'height' => [
                'title' => 'algad.bootstrap::lang.carousel.height.name',
                'type' => 'string',
                'default' => '500px'
            ],
            'borderRadius' => [
                'title' => 'algad.bootstrap::lang.carousel.borderRadius.name',
                'type' => 'string',
                'default' => '10px'
            ]
        ];
    }

    public function getProperty($propertyName)
    {
        return $this->property($propertyName);
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
