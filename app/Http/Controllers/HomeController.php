<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function index(){
        $admin=User::where('admin', '=', '1') -> get();
        $service = Service::all();
        return view('home', compact('admin', 'service'));
    }

    public function showTratt($id){
        
        $service=Service::findOrFail($id);
        return view('show', compact('service' ));
    }
}
