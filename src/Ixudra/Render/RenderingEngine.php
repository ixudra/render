<?php namespace Ixudra\Render;


use App;
use Lang;
use Translate;

class RenderingEngine {

    protected $locale;


    public function __construct($locale = 'en')
    {
        $this->locale = $locale;
    }


    public function getLocale($locale = '')
    {
        if( $locale != '' ) {
            return $locale;
        }

        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }


    public function translate($key, $parameters = array(), $ucFirst = true, $locale = '')
    {
        $message =  Lang::get( $key, $parameters, $this->getLocale($locale) );
        if( $ucFirst ) {
            return ucfirst( $message );
        }

        return $message;
    }


    /*
     *      Date functions
     */

    public function date($date, $dateFormat, $locale = '')
    {
        return App::make('\Ixudra\Render\DateRenderingEngine')->date( $date, $dateFormat, $this->getLocale($locale) );
    }

    public function time($date, $dateFormat, $locale = '')
    {
        return App::make('\Ixudra\Render\DateRenderingEngine')->time( $date, $dateFormat, $this->getLocale($locale) );
    }

    public function dateTime($date, $dateFormat, $locale = '')
    {
        return App::make('\Ixudra\Render\DateRenderingEngine')->dateTime( $date, $dateFormat, $this->getLocale($locale) );
    }


    /*
     *      Numeric functions
     */

    public function number($value, $accuracy, $forcePositive = false)
    {
        if( $forcePositive ) {
            $value = abs( $value );
        }

        return number_format( $value, $accuracy, ',', '.' );
    }

    function currency($value, $accuracy = 0, $forcePositive = false)
    {
        $number = $this->number($value, $accuracy, $forcePositive);
        if( $accuracy > 2 ) {
            $parts = explode(',', $number);

            $intermediate = $parts[ 0 ] .','. substr($parts[ 1 ], 0, 2);
            $trailing = substr($parts[ 1 ], 2);

            $number = $intermediate . rtrim( $trailing, 0 );
        }

        return '€ '. $number;
    }

    function percentage($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->number( $value, $accuracy, $forcePositive) .'%';
    }


    /*
     *      Energy functions
     */

    function usage($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->number( $value, $accuracy, $forcePositive) .' KWh';
    }


    /*
     *      Pricing functions
     */

    public function pricePerMwh($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->currency( $value, $accuracy, $forcePositive) .' / '. Translate::recursive('other.mwh', array(), false);
    }

    public function pricePerYear($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->currency( $value, $accuracy, $forcePositive) .' / '. Translate::recursive('other.year', array(), false);
    }

    public function pricePerMonth($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->currency( $value, $accuracy, $forcePositive) .' / '. Translate::recursive('other.month', array(), false);
    }


    /*
     *      Other functions
     */

    public function fillable($data, $length = 25, $replacement = '')
    {
        if( is_null($data) || empty($data) ) {
            if( $replacement != '' ) {
                $data = $replacement;
            } else {
                $data = str_repeat('.', $length);
            }
        }

        return $data;
    }

    public function website($url)
    {
        $url = str_replace('http://','', $url);
        $url = str_replace('https://','', $url);

        $pos = strpos($url, '/');
        if( $pos === false ) {
//            $url .= 'not';
        } else {
            $url = substr($url, 0, strpos($url, '/'));
        }

        return $url;
    }

}