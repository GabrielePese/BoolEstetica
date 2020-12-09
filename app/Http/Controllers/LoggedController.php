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
        
        $tabella = DB::table('service_user')->where('id', '=', $id)-> get(); // qui prendo dalla tabella service_user dove id e'uguale all'id che gli passiamo noi cioe' id del service_user, cioe'id della prenotazione.
        $tabellaponte = $tabella[0]; // qui prendiamo indice 0 dell'array. cosi ci da i risultati che vogliamo
        
   
               
        
        return view('scrivirecensione', compact('id','tabellaponte'));  
        
       
    }

    public function recensionepost(Request $request, $id){
       
        
        $data = $request -> all();   //prendo i vari dati inseriti nel form
        
        $serviceID = $data['service_ID'];  //definisco i vari dati che mi interessano
        $userID = $data['user_ID'];
        $datastart = $data['date_start'];
        $dateend =$data['date_end'];

        $vote = $data['review_vote'];
        $review_text =$data['review_text'];
        $delete = $data['deleted'];

       
        $data = [    //qui modifico i dati di data

        
        'service_ID' => $serviceID,
        'user_ID'=> $userID,
        'date_end'=> $dateend,

        'review_vote'=> $vote,
        'review_text' =>$review_text,
        'deleted'=> $delete
       
    ];
    

    DB::table('service_user')->where('id', '=', $id)-> update($data);   //faccio update con i data della tabella ponte con id uguale id della prenotazione

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

        $this->apiCalendar();

        $users = User::all();

        return view ('prenotazione' , compact('servizio', 'users'));
    }

    public function apiCalendar(){


        $infoPerCalendario = [ ];
          

        $recensioni = DB::table('service_user')
        ->join('users', 'service_user.user_ID', '=', 'users.id')
        ->join('services', 'service_user.service_ID', '=', 'services.id')
        -> where('deleted', '=' , 0 )
        ->select( 'services.name as title','date_start', 'date_end','users.name', 'service_user.user_ID')
        -> get();
        
        foreach($recensioni as $recensione){

            $titolo_part1 = $recensione -> name;
            $titolo_part2 = $recensione -> title;
            $titolo_tot = $titolo_part1 . " " . $titolo_part2;
            
            
            if (Auth::user()->admin) {
               
                $var = [
                    'title'=> $recensione -> name,
                    'start' => $recensione -> date_start ,
                    'end'  => $recensione -> date_end,
                    'color' => 'grey'
                ];
                
                
                array_push($infoPerCalendario,$var);
            }
            elseif (Auth::user()->id == $recensione -> user_ID) {
                $var = [
                    'title' => $titolo_tot ,
                    'start' => $recensione -> date_start ,
                    'end'  => $recensione -> date_end,
                    'color' => 'green'
                ];
               
                array_push($infoPerCalendario,$var);
            } 
            else {
                $var = [
                    'start' => $recensione -> date_start ,
                    'end'  => $recensione -> date_end,
                    'color' => 'blu'
                ];
               
                array_push($infoPerCalendario,$var);
            }
            
    
        };

        
        return response()->json($infoPerCalendario);
    }
    

    public function prenotastore(Request $request, $id){
        $data = $request -> all();
        $dataorario = $data['dataorario'];
        $datagiorno =$data['datagiorno'];
        

        $servizio = Service::findOrFail($id);
        $utenteID = Auth::user()-> id;
        $utente = User::findOrFail($utenteID);
        
        $durate = $servizio['duration']; //qui prendo la duration di servizio, cioe'il mio service che ho selezionato in questo momento.

        $del =$data['deleted'];
        
        // $datagiorno = Carbon::parse($datagiorno);
        // $dataorario = Carbon::parse($dataorario);

        $date = $datagiorno . ' ' . $dataorario;
        $date_start = Carbon::parse($date);
        

        $date_end = Carbon::parse($datagiorno . ' ' . $dataorario) -> addMinutes($durate); 
        
        $utente -> services()->attach($servizio, [

            'date_start' => $date_start,
            'date_end' => $date_end,
            // 'review_vote' => $review_vote,
            // 'review_text' => $review_text,
            'deleted' => $del
        ]);

        return redirect() -> route('home');
    }

    public function annullaprenotaz($id){
        $prenotazione = DB::table('service_user')-> where('id', '=', $id)->update(['deleted' => 1] );
        
        
        return redirect() -> route('home');
    }


    public function apiCalendarioData($valoreinput){

        // dd($valoreinput);


        $dev = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id')  // prendi dati anche da services dove il service_ID di service_user é uguale al service.id
        ->select('services.id', 'date_start', 'date_end','services.duration','service_user.user_ID', 'service_user.deleted') //prendi questi dati
        ->where('service_user.deleted' , '=', '0') //prendi solo dove service users deleted é 0
        ->whereDate('date_start', $valoreinput) //dove date_start e'uguale e valore input che ti passiamo noi
        ->get();

       

    return response()->json($dev);
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