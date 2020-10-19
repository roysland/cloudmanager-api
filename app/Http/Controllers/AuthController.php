<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Github\Client as GithubClient;

class AuthController extends Controller
{
    public function getCode (Request $request) {
        $code = $request->input('code');
        $client = new Client([
            'base_uri' => 'https://api.github.com/'
        ]);
        $payload = [
            'json' => [
                'client_id' => env('GITHUB_CLIENT'),
                'client_secret' => env('GITHUB_SECRET'),
                'code' => $code,
                'accept' => 'json'
            ]
        ];
        $response = $client->request('POST', 'https://github.com/login/oauth/access_token', $payload);
        $body = $response->getBody();
        parse_str((string) $body, $output);
        if (array_key_exists('access_token', $output)) {
            // Save access token
            $user = $this->getUser($output['access_token']);
            if (User::where('login', $user['login'])->first()) {
                $u = $this->updateUser($user, $output['access_token']);
            } else {
                $u = $this->createUser($user, $output['access_token']);
            }
        }
        return response()->json([
            'data' => $u
        ]);
    }

    public function getUser ($accessToken) {
        $client = new GithubClient();
        $client->authenticate($accessToken, null, \Github\Client::AUTH_ACCESS_TOKEN);
        $user = $client->currentUser();
        return $user->show();
    }

    public function isUser ($user) {
        return User::where('login', $user->login)->first();
    }

    public function createUser ($user, $accessToken) {
        $newUser = new User();
        $newUser->avatar = $user['avatar_url'];
        $newUser->github_id = $user['id'];
        $newUser->location = $user['location'];
        $newUser->login = $user['login'];
        $newUser->name = $user['name'];
        $newUser->repos_url = $user['repos_url'];
        $newUser->url = $user['url'];
        $newUser->api_token = Str::random(16);
        $newUser->access_token = $accessToken;

        $newUser->save();
        return $newUser;
    }

    public function updateUser ($user, $accessToken) {
        $newUser = User::where('login', $user['login'])->first();
        $newUser->avatar = $user['avatar_url'];
        $newUser->github_id = $user['id'];
        $newUser->location = $user['location'];
        $newUser->login = $user['login'];
        $newUser->name = $user['name'];
        $newUser->repos_url = $user['repos_url'];
        $newUser->url = $user['url'];
        $newUser->access_token = $accessToken;

        $newUser->save();
        return $newUser;
    }
}
