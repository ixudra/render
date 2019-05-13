ixudra/render
=====================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ixudra/render.svg?style=flat-square)](https://packagist.org/packages/ixudra/render)
[![license](https://img.shields.io/github/license/ixudra/render.svg)]()
[![Total Downloads](https://img.shields.io/packagist/dt/ixudra/render.svg?style=flat-square)](https://packagist.org/packages/ixudra/render)

Custom PHP rendering package for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

This package provides several utility methods that allow you to easily display several pieces of information such as dates, prices and much more. All of these representations can be configured depending on the locale of the user. This gives you the ability to display data in a way that is most desirable for your users without difficulty.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.

 > Note before posting an issue: When posting an issue for the package, always be sure to provide as much information 
 > regarding the problem as possible. 



## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "ixudra/render": "1.*"
        }
    }

```

or run in terminal: `composer require ixudra/render`

### Laravel 5.5+ Integration

Laravel's package discovery will take care of integration for you.


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'     => array(

        //...
        Ixudra\Render\RenderServiceProvider::class,

    ),

```

Add the facade to your app.php file

```php

    'facades'       => array(

        //...
        'Render'        => Ixudra\Render\Facades\Render::class,

    ),

```



## Usage

Once all dependencies have been included and migrations have been run, you can start using the package:

```php

    // Set the locale of the rendering engine so you don't have to repeat it all the time. This will remain set until manually changed
    Render::setLocale('en');


    // Translate the message in the app default app locale
    Render::translate('your.key.goes.here');

    // Translate the message recursively in a given locale - see [ixudra/translations](https://github.com/ixudra/translation) for details on recursive translations
    Render::recursive('admin.menu.title.new', array('model' => 'user'), true, $locale);


    // Display a date in the default app locale 
    Render::date( '02/06/15', 'd/m/y' );

    // Display a date in a specific locale 
    Render::date( '02/06/15', 'd/m/y', 'en' );


    // Display a value as currency in the default app locale 
    Render::currency( 5123.6598 );              // Returns € 5.123,65

    // Display a value as currency in a specific locale - COMING SOON
    Render::currency( 5123.6598, 'us' );        // Returns $ 5.123,65

```



That's all there is to it! Have fun!




## Support

Help me further develop and maintain this package by supporting me via [Patreon](https://www.patreon.com/ixudra)!!




## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

For package questions, bug, suggestions and/or feature requests, please use the Github issue system and/or submit a pull request. When submitting an issue, always provide a detailed explanation of your problem, any response or feedback your get, log messages that might be relevant as well as a source code example that demonstrates the problem. If not, I will most likely not be able to help you with your problem. Please review the [contribution guidelines](https://github.com/ixudra/curl/blob/master/CONTRIBUTING.md) before submitting your issue or pull request.

For any other questions, feel free to use the credentials listed below: 

Jan Oris (developer)

- Email: jan.oris@ixudra.be
- Telephone: +32 496 94 20 57

