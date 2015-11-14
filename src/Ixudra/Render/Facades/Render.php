<?php namespace App\Modules\Render\Facades;


use Illuminate\Support\Facades\Facade;

class Render extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Render';
    }

}