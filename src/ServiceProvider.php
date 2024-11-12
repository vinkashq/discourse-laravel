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
    $this->publishesMigrations([
      __DIR__.'/../database/migrations' => database_path('migrations'),
    ], 'discourse-migrations');
    $this->loadRoutesFrom(__DIR__.'/../routes/discourse.php');
  }

}
