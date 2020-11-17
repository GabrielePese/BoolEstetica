<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Service;
use App\ServiceUser;
use App\User;
use Auth;
use Carbon\Carbon;
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

    
   


    public function profilo($id){
        $users = User::all();
        $userUtente = User::findOrFail($id);  //qui prendo il singolo utente, che poi utilizzeró sotto anche se prendera'tutti gli utenti (non so il perche')
        $services = Service::all();
        
        $ora = Carbon::now();
        $date_now = Carbon::parse($ora); //permette a carbon di leggere orario
        $date_now -> addHours(1); //aggiungo alla data un ora perche'lui prende la data di Londra quindi con un ora in meno
        
        $prenotazioni = $userUtente-> services->first()->pivot->get();  // prendo il contenuto nella tabella ponte UserService. 
               
        
        return view('profilo', compact('prenotazioni', 'users','userUtente', 'services', 'date_now'));  
    }

    public function scrivirecensione($id){
        $users = User::all();
        $prova = DB::table('service_user')->where('id', '=', $id)-> get();
        $provaOK = $prova[0];
        
        // $userUtente = User::findOrFail($);  //qui prendo il singolo utente, che poi utilizzeró sotto anche se prendera'tutti gli utenti (non so il perche')
        // $services = Service::all();
        
        // $ora = Carbon::now();
        // $date_now = Carbon::parse($ora); //permette a carbon di leggere orario
        // $date_now -> addHours(1); //aggiungo alla data un ora perche'lui prende la data di Londra quindi con un ora in meno
        
        // $prenotazioni = $users-> services->first()->pivot->get();  // prendo il contenuto nella tabella ponte UserService. 
               
        
        return view('scrivirecensione', compact('id','provaOK'));  
        
       
    }

    public function recensionepost(Request $request, $id){
        // $prova = DB::table('service_user')->where('id', '=', $id)-> get();
        // $provaOK = $prova[0];
        
        $data = $request -> all();
        
        $serviceID = $data['service_ID'];
        $userID = $data['user_ID'];
        $dateend =$data['date_end'];

        $vote = $data['review_vote'];
        $review_text =$data['review_text'];
        $delete = $data['deleted'];

       
        $data = [

        
        'service_ID' => $serviceID,
        'user_ID'=> $userID,
        'date_end'=> $dateend,

        'review_vote'=> $vote,
        'review_text' =>$review_text,
        'deleted'=> $delete
       
    ];
    

    DB::table('service_user')->where('id', '=', $id)-> update($data); 

    return redirect() -> route('home');
    }
    public function createTratt()
    {
        
        $service = Service::all();
        return view('create-tratt', compact('service'));
    }

    public function storeTratt(Request $request ){
        $data = $request -> all();
        $servizio = Service::create($data);
        
        return redirect() -> route('home');
    }



    public function prenota($id){
        $servizio = Service::findOrFail($id);
        
        return view ('prenotazione' , compact('servizio'));
    }
    

    public function prenotastore(Request $request, $id){
        $data = $request -> all();
        $servizio = Service::findOrFail($id);
        $utenteID = Auth::user()-> id;
        $utente = User::findOrFail($utenteID);
        
        $durate = $servizio['duration']; //qui prendo la duration di servizio, cioe'il mio service che ho selezionato in questo momento.

        // $review_vote = $data['review_vote'];
        // $review_text = $data['review_text'];
        $del =$data['deleted'];
        
        $ora = Carbon::now();
        $date_end = Carbon::parse($ora); //permette a carbon di leggere orario
        $date_end -> addHours(1); // per sistemare fuso orario,lui prende quello di londra che ha un'ora in meno quindi l'aggiungo io.
        $date_end -> addMinutes($durate); 
       
        

        
        
                
        $utente -> services()->attach($servizio, [
            'date_end' => $date_end,
            // 'review_vote' => $review_vote,
            // 'review_text' => $review_text,
            'deleted' => $del
        ]);

        return redirect() -> route('home');
    }

    public function promo($id){
        $service = Service::findOrFail($id);
        $promotions = Promotion::all();
        return view('select-promo' ,compact ('service', 'promotions'));

    }

    public function aggiungipromo(Request $request, $id){
        $service = Service::findOrFail($id);
        
        if ($service['promotion']) {   //qui se ho gia'una promo attiva. 
            
            $promo = $request->input('subscription');
        
            
            $data = ['name' => $service['name'],
            'description'=> $service['description'],
            'duration'=> $service['duration'],
            'price'=> $service['originalprice'],
            'originalprice' => $service['originalprice'],
            'photo'=> $service['photo'],
            'video'=> $service['video'],
            'promotion'=> 0,
            'disabled'=> $service['disabled'],
            'delete'=> $service['delete']
        ];
        $serviceUpdate = Service::where( 'id', $id )->update($data); 
        }
        else{ //qui quando non ho promo attive.
            
            $promo = $request->input('subscription'); // prendo il promo-> discount quindi lo sconto
        

            $prezzoServizio =$service['originalprice']; //salvo il prezzo originale
          
            $calcolo = $prezzoServizio * $promo / 100; 
            $prezzoScontato = $prezzoServizio - $calcolo;

    

            $data = ['name' => $service['name'],    //creo array(di Service) DATA con i dati che modifico, qui modifico solo il price e promotion le altre cose le lascio invariate.
            'description'=> $service['description'],
            'duration'=> $service['duration'],
            'price'=> $prezzoScontato,
            'originalprice' => $service['originalprice'],
            'photo'=> $service['photo'],
            'video'=> $service['video'],
            'promotion'=> 1,
            'disabled'=> $service['disabled'],
            'delete'=> $service['delete']
        ];
        $serviceUpdate = Service::where( 'id', $id )->update($data); 

        }


        

     return redirect() -> route('show-tratt', $id); 
}
    public function createpromo(){
        return view('create-promo');
}
    public function createpromostore(Request $request){
        $data = $request -> all();
        $promo = Promotion::create($data);


        return redirect() -> route('home');
    }
}