<?php
namespace repat\LaravelHelper;

use Illuminate\Support\Facades\Facade;
/**
 * @see \repat\LaravelHelper\Helper
 */
class HelperFacade extends Facade {
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'repat-laravel-helper'; }
}
