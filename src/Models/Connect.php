<?php

namespace Vinkas\Discourse\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Connect extends Model
{

  protected $table = 'discourse_connects';
  protected $_client, $sso, $sig;

  public function getHostAttribute() {
    return parse_url($this->url, PHP_URL_HOST);
  }

  public function validate($sso, $sig) {
    $this->setClientAttributes($sso, $sig);
    return $this->client->isValid();
  }

  public function setClientAttributes($sso, $sig) {
    $this->sso = $sso;
    $this->sig = $sig;
  }

  public function getClientAttribute() {
    if ($this->_client) return $this->_client;

    $this->_client = (new Client($this->host, true))->connect($this->secret, $this->sso, $this->sig);
    return $this->_client;
  }

  public function getResponseUrl($userParams) {
    return $this->client->getResponseUrl($userParams);
  }
}
