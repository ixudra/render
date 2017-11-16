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
        if( $locale !== '' ) {
            return $locale;
        }

        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }


    /**
     * @param   mixed       $key                Translation key to be used
     * @param   array       $parameters         Array of parameters needed for the translation key
     * @param   bool        $ucFirst            Indicate whether or not the translated string should be capitalised
     * @param   string      $locale             Locale you would like to translate to. If none provided, the default will be used
     * @return string
     */
    public function translate($key, array $parameters = array(), $ucFirst = true, $locale = '')
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

    /**
     * @param   mixed       $date               Date you want to format
     * @param   string      $dateFormat         Current format in which the $date variable is provided
     * @param   string      $locale             Locale you would like to convert to
     * @return string
     */
    public function date($date, $dateFormat = 'Y-m-d', $locale = '')
    {
        return App::make( DateRenderingEngine::class )->date( $date, $dateFormat, $this->getLocale($locale) );
    }

    /**
     * @param   mixed       $date               Date you want to format
     * @param   string      $dateFormat         Current format in which the $date variable is provided
     * @param   string      $locale             Locale you would like to convert to
     * @return string
     */
    public function time($date, $dateFormat = 'Y-m-d H:i:s', $locale = '')
    {
        return App::make( DateRenderingEngine::class )->time( $date, $dateFormat, $this->getLocale($locale) );
    }

    /**
     * @param   mixed       $date               Date you want to format
     * @param   string      $dateFormat         Current format in which the $date variable is provided
     * @param   string      $locale             Locale you would like to convert to
     * @return string
     */
    public function dateTime($date, $dateFormat = 'H:i:s', $locale = '')
    {
        return App::make( DateRenderingEngine::class )->dateTime( $date, $dateFormat, $this->getLocale($locale) );
    }


    /*
     *      Numeric functions
     */

    public function number($value, $accuracy, $forcePositive = false)
    {
        if( $forcePositive ) {
            $value = abs( $value );
        }

        if( $value === '' || is_null($value) ) {
            $value = 0;
        }

        $number = number_format(str_replace(',', '.', $value), $accuracy, ',', '.');
        if( $accuracy > 2 ) {
            $trimmed = rtrim($number, '0');
            $commaPosition = strpos($trimmed, ',');
            if( strlen($trimmed) < $commaPosition + 2 && $commaPosition != strlen($number) - 2 ) {
                $number = $trimmed . str_repeat('0', $commaPosition + 2 - (strlen($trimmed) - 1));
            } else {
                $number = $trimmed;
            }
        }

        return $number;
    }

    public function currency($value, $accuracy = 0, $forcePositive = false, $useNonBreakingSpace = true)
    {
        $space = ' ';
        if( $useNonBreakingSpace ) {
            $space = '&nbsp;';
        }

        return '€'. $space . $this->number( $value, $accuracy, $forcePositive);
    }

    public function percentage($value, $accuracy = 2, $forcePositive = false)
    {
        return $this->number( $value, $accuracy, $forcePositive) .'%';
    }


    /*
     *      Energy functions
     */

    public function usage($value, $accuracy = 2, $forcePositive = false)
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
            if( $replacement !== '' ) {
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