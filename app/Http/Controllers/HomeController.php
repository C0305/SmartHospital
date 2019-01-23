<?php

namespace SmartHospital\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SmartHospital\Models\General\MexicoState;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show(){
        $data = [
            'user' => [
                'name' => Auth::user()->name,
                'mainHeader' => [
                    'weather' => 'true',
                    'events' => 'false',
                    'messages' => 'false',
                ]
            ],
            'mexicoStates' => MexicoState::select('id','federal_entity as label')->get()
        ];

        return $data;
    }

}
