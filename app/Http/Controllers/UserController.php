<?php

namespace App\Http\Controllers;

use Github\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function me () {
        return response()->json(['user' => Auth::user()]);
    }

    public function repos () {
        $user = Auth::user();
        $client = new Client();
        $client->authenticate($user->access_token, null, \Github\Client::AUTH_ACCESS_TOKEN);
        $repos = $client->api('user')->repositories($user->login);
        return response()->json(['repos' => $repos]);
    }
}
