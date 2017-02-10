<?php namespace Ixudra\Render;


use Illuminate\Support\ServiceProvider;

class RenderServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $this->app->singleton('Render', function () {
                return new RenderingEngine();
            }
        );
    }

    public function provides()
    {
        return array('Render');
    }

}
