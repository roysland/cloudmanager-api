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

    public function repos (Request $request) {
        $page = 1;
        if ($request->input('page')) {
            $page = $request->input('page');
        }
        $user = Auth::user();
        $client = new Client(null, null, env('GITHUB_URL'));;
        $client->authenticate($user->access_token, null, \Github\Client::AUTH_ACCESS_TOKEN);
        $result = $client->api('search')->repositories('org:aftenbladet-mm', 'updated', 'desc');

        return response()->json(['repos' => $result, 'page' => $page]);
    }
}
