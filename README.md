ixudra/render
=====================

Custom PHP rendering package for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

This package provides several utility methods that allow you to easily display several pieces of information such as dates, prices and much more. All of these representations can be configured depending on the locale of the user. This gives you the ability to display data in a way that is most desirable for your users without difficulty.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "ixudra/render": "0.*"
        }
    }

```

```php

    'providers'     => array(

        //...
        Ixudra\Render\RenderServiceProvider::class,

    ),

```

Add the facade to your `config/app.php` file:

```php

    'facades'       => array(

        //...
        'Render'          => Ixudra\Render\Facades\Render::class,

    ),

```



## Usage

Once all dependencies have been included and migrations have been run, you can start using the package:

```php

    // Display a date in the default app locale 
    Render::date( '02/06/15', 'd/m/y' );

    // Display a date in a specific locale 
    Render::date( '02/06/15', 'd/m/y', 'es' );

    
    // Display a value as currency in the default app locale 
    Render::date( 23.659 );             // Returns € 5.123,65

    // Display a value as currency in a specific locale - COMING SOON
    Render::date( 5123.6598, 'us' );    // Returns $ 5.123,65


```



That's all there is to it! Have fun!




## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

Jan Oris (developer)

- Email: jan.oris@ixudra.be
- Telephone: +32 496 94 20 57

