<?php

namespace App\Http\Controllers;

use App\ServiceUser;
use App\Service;
use App\Service_User;
use App\User;
use Phpfastcache\Helper\Psr16Adapter;
use GuzzleHttp\Client;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller{
    public function index(){
        
 
        $user = User::all();
        $service = Service::all();
        
        return view('home', compact('service', 'user' ));
    }

    public function showTratt($id){
        $user = User::all();
        $service=Service::findOrFail($id);

        $recensioni = DB::table('service_user') // nel joi unisco la tabella user id al user_ID della tabella ponte, cioé sto entrando dalla tabella ponte nella tabella user
        ->join('users', 'service_user.user_ID', '=', 'users.id')
        -> where('service_ID', '=' , $id ) //seleziono solo dove il service_ID e' uguale all'id del servizio, quindi all servizio della show.
        -> get();
        

        $votoRecensioniTotali = DB::table('service_user') // nel joi unisco la tabella user id al user_ID della tabella ponte, cioé sto entrando dalla tabella ponte nella tabella user
        -> where('service_ID', '=' , $id ) 
        ->select('review_vote')//seleziono solo dove il service_ID e' uguale all'id del servizio, quindi all servizio della show.
        -> sum('review_vote');

        $quantitaRecensioni =  DB::table('service_user') // nel joi unisco la tabella user id al user_ID della tabella ponte, cioé sto entrando dalla tabella ponte nella tabella user
        -> where([
                 ['service_ID', '=' , $id],
                 ['review_vote', '!=', 'NULL'] 
        ]) 
        ->select('review_vote')//seleziono solo dove il service_ID e' uguale all'id del servizio, quindi all servizio della show.
        -> count();

       

        
              return view('show', compact('service', 'recensioni', 'user', 'votoRecensioniTotali', 'quantitaRecensioni' ));
    }

    public function trattamenti(){
       
        $servizi = Service::orderBy('name', 'asc')->get();   //prende tutti ma sortati in ordine alfabvetico crescente sul nome

        return view('trattamenti', compact('servizi'));
    }
}
   

