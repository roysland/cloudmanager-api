<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //

    public function store (Request $request) {
        /* $service = new Service();
        $service->user_id = Auth::id();
        $service->type = $request->input('service')['short'];
        $service->repo = $request->input('repo')['name']; */
    }
}
