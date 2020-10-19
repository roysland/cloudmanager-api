<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getServices () {
        $services = Service::all();
        return response()->json(['services' => $services]);
    }

    public function getService ($service) {
        $service = Service::find($service);
        $owner = false;
        if (Auth::id() === $service->user_id) {
            $owner = true;
        }
        return response()->json([
            'service' => $service,
            'owner' => $owner
        ]);
    }

    public function store (Request $request) {
        $config = [];
        $input = $request->all();
        
        $config['type'] = $input['service']['type'];
        $service = new Service();
        $service->user_id = Auth::id();
        $service->type = $input['service']['short'];
        if ($input['service']['short'] == 'front' || $input['service']['short'] == 'backend') {
            $service->repo = $input['repo'];
            // Notice: Config should be the same for any service. 
            $config['build'] =  $input['service']['build'];
            
        }
        $service->config = $config;
        $service->save();
       
        return response()->json([
            'service' => $service
        ]); 
    }
}
