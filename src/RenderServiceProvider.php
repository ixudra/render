<?php namespace Ixudra\Render;


use Illuminate\Support\ServiceProvider;

class RenderServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $configPath = __DIR__ . '/config/config.php';

        $this->mergeConfigFrom($configPath, 'render');

        $this->publishes(array(
            $configPath         => config_path('render.php'),
        ), 'config');

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
