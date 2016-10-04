<?php

namespace Vinkas\Discourse\Laravel;

use Illuminate\Support\ServiceProvider;

class DiscourseServiceProvider extends ServiceProvider
{
  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__.'../database/migrations');
  }

}
