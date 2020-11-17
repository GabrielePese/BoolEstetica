<?php

namespace App\Http\Controllers;

use App\ServiceUser;
use App\Service;
use App\Service_User;
use App\User;
use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function index(){

 
        $user = User::all();
        $service = Service::all();

    
        
        return view('home', compact('service', 'user' ));
    }

    public function showTratt($id){
        
        $service=Service::findOrFail($id);
        return view('show', compact('service'));
    }

   
}
