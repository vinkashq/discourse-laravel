<?php

namespace Vinkas\Discourse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    if (!$connect->validate($sso, $sig)) {
      return response()->json(['error' => 'Bad SSO request'], 403);
    }

    $user = $request->user();
    if (!$user) {
      session('discourse_connect', $connect->key);
      session('discourse_sso', $sso);
      session('discourse_sig', $sig);
      return redirect('/login');
    }

    return $connect->redirect();
  }
}
