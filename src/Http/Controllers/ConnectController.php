<?php

namespace Vinkas\Discourse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkas\Discourse\Client;
use Vinkas\Discourse\Models\Connect;

class ConnectController extends Controller
{
  public function show(Request $request, string $key)
  {
    $connect = Connect::where('key', $key)->first();
    if (!$connect) {
      return response()->json(['error' => 'Invalid key'], 404);
    }

    $sso = $request->input('sso');
    $sig = $request->input('sig');
    if (!$sso || !$sig) {
      return response()->json(['error' => 'Invalid request'], 400);
    }

    $host = parse_url($connect->url, PHP_URL_HOST);
    $client = new Client($host, true);
    $connect = $client->connect($connect->secret, $sso, $sig);

    if (!($connect->isValid())) {
      header("HTTP/1.1 403 Forbidden");
      echo("Bad SSO request");
      die();
    }

    $user = $request->user();

    if (!$user) {
      return redirect('/login')->cookie('discourse_connect', $connect->key);
    }

    $userParams = array(
        'external_id' => $user->id,
        'email'     => $user->email,
        'username' => $user->username,
        'name'     => $user->name
    );

    $url = $connect->getResponseUrl($userParams);
    return redirect($url);
  }
}
