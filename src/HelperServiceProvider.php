<?php
namespace repat\LaravelHelper;

use repat\LaravelHelper\Helper;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {
  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = true;
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->registerHelper();
    $this->app->alias('repat-laravel-helper', 'repat\LaravelHelper\Helper');
  }
  /**
   * Register the Goutte instance.
   *
   * @return void
   */
  protected function registerHelper()
  {
    $this->app->bindShared('repat-laravel-helper', function($app)
    {
      return new \repat\LaravelHelper\Helper();
    });
  }
  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return [ 'repat-laravel-helper' ];
  }
}
