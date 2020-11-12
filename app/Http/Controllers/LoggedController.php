<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedController extends Controller
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

    
    // public function index()
    // {
    //     $user=User::all();
       
    //     return view('home', compact('user'));
    // }

    public function createTratt()
    {
        $admin=User::where('admin', '=', '1') -> get();
        $service = Service::all();
        return view('create-tratt', compact('admin','service'));
    }

    public function storeTratt(Request $request ){
        $data = $request -> all();
        $servizio = Service::create($data);

        return redirect() -> route('home');
    }

    public function prenota($id){
        $servizio = Service::findOrFail($id);
        $utente = User::findOrFail($id);
        $admin=User::where('admin', '=', '1') -> get();
       

        return view ('prenotazione' , compact('servizio', 'utente', 'admin'));
    }

    public function prenotastore(Request $request){
        $data = $request -> all();
        
        $id = Auth::user() -> id;
        
        $utente = User::findOrFail($id);
        
        $utente -> services()->attach($data);

        return redirect() -> route('home');
    }
}
