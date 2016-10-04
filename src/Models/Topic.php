<?php

namespace Vinkas\Discourse\Laravel\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

  protected $table = 'discourse_topics';

  /**
   * Get the Discourse that owns the topic.
   */
  public function forum()
  {
    return $this->belongsTo('Vinkas\Discourse\Laravel\Models\Forum');
  }

}
