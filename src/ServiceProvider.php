<?php

namespace Vinkas\Discourse;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__.'../database/migrations');
    $this->loadRoutesFrom(__DIR__.'/../routes/discourse.php');
  }

}
