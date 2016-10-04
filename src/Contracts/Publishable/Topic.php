<?php

namespace Vinkas\Discourse\Laravel\Contracts\Publishable;

interface Topic
{

  public function getPublishableTitle();

  public function getPublishableRaw();

  public function getDiscourseCategory();

}
