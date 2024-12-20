<?php

namespace Vinkas\Discourse\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkas\Discourse\Client;

/**
 *
 */
class Connect extends Model
{

  protected $table = 'discourse_connects';
  protected $_client, $sso, $sig;

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

    $this->_client = (new Client($this->url))->connect($this->secret, $this->sso, $this->sig);
    return $this->_client;
  }

  public function getResponseUrl() {
    $user = auth()->user();

    $userParams = array(
      'external_id' => $user->id,
      'email'     => $user->email,
      'username' => $user->username,
      'name'     => $user->name
    );

    return $this->client->getResponseUrl($userParams);
  }

  public function getRedirectResponse() {
    $url = $this->getResponseUrl();
    session()->forget('discourse_connect');
    session()->forget('discourse_sso');
    session()->forget('discourse_sig');
    return redirect($url);
  }

  public static function find() {
    if (auth()->guest() || !session('discourse_connect')) {
      return;
    }

    $connect = self::where('key', session('discourse_connect'))->first();
    if ($connect && session('discourse_sso') && session('discourse_sig')) {
      $connect->setClientAttributes(session('discourse_sso'), session('discourse_sig'));
      return $connect;
    }

    return;
  }
}
