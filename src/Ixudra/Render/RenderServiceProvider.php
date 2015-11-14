<?php namespace Ixudra\Render;


use Illuminate\Support\ServiceProvider;

class RenderServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $this->app['Render'] = $this->app->share(
            function($app)
            {
                return new RenderingEngine();
            }
        );
    }

    public function provides()
    {
        return array('Render');
    }

}
