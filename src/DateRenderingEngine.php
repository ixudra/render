<?php namespace Ixudra\Render;


use Config;
use Carbon\Carbon;

class DateRenderingEngine {

    public function date($value, $dateFormat = 'Y-m-d', $locale = '')
    {
       return $this->render( $value, $dateFormat, 'date', $locale );
    }

    public function time($value, $dateFormat = 'H:i:s', $locale = '')
    {
       return $this->render( $value, $dateFormat, 'date', $locale );
    }

    public function dateTime($value, $dateFormat = 'Y-m-d H:i:s', $locale = '')
    {
       return $this->render( $value, $dateFormat, 'date', $locale );
    }

    protected function render($value, $dateFormat, $key, $locale)
    {
        if( !( $value instanceof Carbon ) ) {
            $value = Carbon::createFromFormat($dateFormat, $value);
        }

        return $value->formatLocalized( $this->getFormat($key, $locale) );
    }

    protected function getFormat($key, $locale)
    {
        if( $locale == '' ) {
            $locale = 'default';
        }

        if( !Config::has('render.'. $key .'.'. $locale) ) {
            $locale = 'default';
        }

        return Config::get('render.'. $key .'.'. $locale);
    }

}