<?php

namespace Vinkas\Discourse\Laravel\Traits\Publishable;

trait Topic
{

  public function getPublishableTitle() {

  }

  /**
   * Get the unique identifier for the topic.
   *
   * @return string
   */
  public function setDiscourseTopicId(int $id) {

  }

  /**
   * Get the column name for the "remember me" token.
   *
   * @return string
   */
  public function getRememberTokenName()
  {
    return 'discourse_topic_id';
  }
}
