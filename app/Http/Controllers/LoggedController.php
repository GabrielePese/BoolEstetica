<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrattamentoPrenotato;
use App\Mail\TrattamentoAnnullato;


use App\Service;
use App\ServiceUser;
use App\User;
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
        $date_now  -> addHours(1); //aggiungo alla data un ora perche'lui prende la data di Londra quindi con un ora in meno
       
        
        $prenotazioni = $userUtente-> services->first();  // prendo il contenuto nella tabella ponte UserService. 
        if($prenotazioni){
            $prenotazioniNuovo = DB::table('service_user')
            ->join('users', 'service_user.user_ID', '=', 'users.id')
            ->join('services', 'service_user.service_ID', '=', 'services.id')
            ->select(
                DB::raw('service_user.id as idPrenotazione'),
                DB::raw('DATE_FORMAT(date_start, "%Y-%m-%d %H:%i") as new_start'),
                DB::raw('DATE_FORMAT(date_end, "%Y-%m-%d %H:%i") as new_end'),
                DB::raw('services.name as title'),
                DB::raw('users.name as userName'),
                DB::raw('service_user.user_ID'),
                DB::raw('services.id as idServizio'),
                DB::raw('service_user.review_vote as votoRecensione'))
                
                -> where([
                    ['deleted', '=' , 0],
                    ['users.id', '=', $id]
                    ])
               
                    -> get();
                    
             

            
            // $prenotazioniNuovo = $userUtente-> services->first()->pivot->get();
                
        }
        else {
            return view ('paginaNOdati');
        }

               
             
        
        return view('profilo', compact('prenotazioniNuovo', 'users','userUtente', 'services', 'date_now'));  
    }

    public function scrivirecensione($idPrenotazione){
        
        $tabella = DB::table('service_user')->where('id', '=', $idPrenotazione)-> get(); // qui prendo dalla tabella service_user dove id e'uguale all'id che gli passiamo noi cioe' id del service_user, cioe'id della prenotazione.
        $tabellaponte = $tabella[0]; // qui prendiamo indice 0 dell'array. cosi ci da i risultati che vogliamo
        
               
        
        return view('scrivirecensione', compact('idPrenotazione','tabellaponte'));  
        
       
    }

    public function recensionepost(Request $request, $idPrenotazione){
       
        
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
    

    DB::table('service_user')->where('id', '=', $idPrenotazione)-> update($data);   //faccio update con i data della tabella ponte con id uguale id della prenotazione

    return redirect() -> route('home');
    }


    public function createTratt()
    {
        
        $service = Service::all();


        return view('create-tratt', compact('service'));
    }


    public function storeTratt(Request $request){
        
        $data = $request -> all();
        
        $data = $request -> validate([
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'description' => ['required', 'string', 'min:2', 'max:500'],
            'type' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'originalprice' => 'required',
            'photo' => 'required|image|mimes:JPG,jpeg,png,jpg,webp',
            'video' => 'integer',
            'promotion' => 'integer',
            'disabled' => 'integer',
            'delete' => 'integer',
            ]);
            
            $imagePath = $request-> photo;
            // prendo solo in nome originale
            $imageName = $imagePath->getClientOriginalName();
            // creo una variabile con dentro le info per per il savataggio e faccio il prepend della data attuale in secondi per evitare conflitti nel nome
            $filePath = $request-> photo ->storeAs('images', $imageName, 'public');
            // aggiungo la stringa del percorso /storage/ da aggiungere al DB
            $data['photo'] = '/storage/'.$filePath;
        
            
           
       Service::create($data);

        return redirect()->route('home') -> with('status', 'Nuovo Trattamento Creato!!!');

      
     

      
    }



    public function visualizzaCalendario(){
        return view('visualizzaCalendario');
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
        ->select( 'services.name as title','date_start', 'date_end','users.name', 'service_user.user_ID', 'services.id as idServizio')
        -> get();
        
        foreach($recensioni as $recensione){

            $titolo_part1 = $recensione -> name;
            $titolo_part2 = $recensione -> title;
            $titolo_tot = $titolo_part1 . " " . $titolo_part2;
            
            
            if (Auth::user()->admin) {
               
                if (($recensione -> idServizio) == 1) {
                    $var = [
                        'title'=> 'Non disponibile',
                        'start' => $recensione -> date_start ,
                        'end'  => $recensione -> date_end,
    
                        'color' => 'red'
                    ];
                }else {
                    $var = [
                        'title'=> $titolo_tot,
                        'start' => $recensione -> date_start ,
                        'end'  => $recensione -> date_end,
    
                        'color' => 'grey'
                    ];
                    
                }
                
                
                array_push($infoPerCalendario,$var);
            }
            elseif (Auth::user()->id == $recensione -> user_ID) {
                $var = [
                    'title' => $titolo_tot ,
                    'start' => $recensione -> date_start ,
                    'end'  => $recensione -> date_end,
                    'color' => 'rgba(243, 206, 245, 0.8)',
                    'textColor' => 'black'
                    
                ];
               
                array_push($infoPerCalendario,$var);
            } 
            else {
                $var = [
                    'start' => $recensione -> date_start ,
                    'end'  => $recensione -> date_end,
                    'color' => 'rgba(237, 161, 180, 0.4)'
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
        $user_id = $data['user_ID'];
        
        
        $servizio = Service::findOrFail($id);
        $utenteID = Auth::user()-> id;
        // $utente = User::findOrFail($utenteID);
        $utente = User::findOrFail($user_id);
        $nomeUtente = $utente['name'];
        
        $durate = $servizio['duration']; //qui prendo la duration di servizio, cioe'il mio service che ho selezionato in questo 

        $del =$data['deleted'];
        
        // $datagiorno = Carbon::parse($datagiorno);
        // $dataorario = Carbon::parse($dataorario);

        $date = $datagiorno . ' ' . $dataorario;
        $date_start = Carbon::parse($date);
        
        $orarioMail = Carbon::parse($dataorario) -> addMinutes($durate) -> format('H:i');
        

        $date_end = Carbon::parse($datagiorno . ' ' . $dataorario) -> addMinutes($durate); 
        
        $utente -> services()->attach($servizio, [

            'date_start' => $date_start,
            'date_end' => $date_end,
            // 'review_vote' => $review_vote,
            // 'review_text' => $review_text,
            'deleted' => $del
        ]);

        


        // Mail::to('trattamentoprenotato@amministrazione.com')
        // ->send(new TrattamentoPrenotato($utente,$datagiorno,$dataorario,$orarioMail,$servizio));

       

        return redirect() -> route('home');
    }
    
    public function impostaferieGet($id = 1){
        $servizio = Service::findOrFail($id);

        $this->apiCalendar();

        $users = User::all();

        return view ('prenotazione' , compact('servizio', 'users'));
    }

    public function impostaferie(Request $request, $id){
        $data = $request -> all();
       
        $dataorarioInizio = $data['dataOrarioInizio'];
        $dataorarioFine = $data['dataOrarioFine'];
        $datagiorno =$data['datagiorno'];
        
        
        // dd($data);
        $servizio = Service::findOrFail($id);
        $utenteID = Auth::user()-> id;
        $utente = User::findOrFail($utenteID);
        
        
        
        
        // $datagiorno = Carbon::parse($datagiorno);
        // $dataorario = Carbon::parse($dataorario);

        $dateInizio = $datagiorno . ' ' . $dataorarioInizio;
        $dateFine = $datagiorno . ' ' . $dataorarioFine;
        $date_start = Carbon::parse($dateInizio);
        $date_end = Carbon::parse($dateFine);

        
        
        $utente -> services()->attach($servizio, [

            'date_start' => $date_start,
            'date_end' => $date_end,
            // 'review_vote' => $review_vote,
            // 'review_text' => $review_text,
            'deleted' => 0
        ]);
        return redirect() -> route('home');
    }

    public function annullaprenotaz($idPrenotazione){

        $dati = DB::table('service_user')
        -> where('service_user.id', '=', $idPrenotazione)
        ->join('users', 'service_user.user_ID', '=', 'users.id')
        ->join('services', 'service_user.service_ID', '=', 'services.id')
        ->select( 'services.name as title','date_start', 'date_end','users.name', 'service_user.user_ID', 'services.id as idServizio')
        ->get();

        $prenotazione = DB::table('service_user')
        -> where('service_user.id', '=', $idPrenotazione)
        ->update(['deleted' => 1] );

            // dd($dati);

        // Mail::to('trattamentoannullato@amministrazione.com')
        // ->send(new TrattamentoAnnullato($dati));
        
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

    public function statistiche (){
        $utenti = User::all();

        $annoAttuale = Carbon::now()->format('Y');

        $fatturato = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id' )
        ->select('services.price')
        ->where('service_user.deleted' , '=', '0')
        ->whereYear('date_start', $annoAttuale)
        ->sum('services.price');

        $fatturatoMese = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id' )
        ->select(DB::raw('YEAR(date_start) year, MONTH(date_start) month'), DB::raw('count(*) as totale_servizi_del_mese'), DB::raw('SUM(services.price) as somma'))
        ->where('service_user.deleted' , '=', '0')
        ->whereYear('date_start', $annoAttuale)
        ->groupby('year','month')
        ->get();

       

        $serviziTotaliAnno = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id' )
        ->where('service_user.deleted' , '=', '0')
        ->whereYear('date_start', $annoAttuale)
        ->count();

        
        $serviziInPercentuale = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id' )
        ->select(DB::raw('count(*) as totale_servizi_fatti, services.id'), 'services.name')
        ->where('service_user.deleted' , '=', '0')
        ->whereYear('date_start', $annoAttuale)
        ->groupBy('services.id')
        ->get();

        
        
       
    
        return view('statistiche', compact ('utenti', 'fatturato', 'annoAttuale', 'serviziInPercentuale', 'serviziTotaliAnno', 'fatturatoMese'));
    }
    public function fatturatoMeseChart(){

        $annoAttuale = Carbon::now()->format('Y');

        $fatturatoMese = DB::table('service_user')
        ->join('services', 'service_user.service_ID', '=', 'services.id' )
        ->select(DB::raw('YEAR(date_start) year, MONTH(date_start) month'), DB::raw('count(*) as totale_servizi_del_mese'), DB::raw('SUM(services.price) as somma'))
        ->where('service_user.deleted' , '=', '0')
        ->whereYear('date_start', $annoAttuale)
        ->groupby('year','month')
        ->get();

  
    return response()->json($fatturatoMese);
}

    public function apiStatistiche($idUtenteSelezionato){
        
        $annoAttuale = Carbon::now()->format('Y');

        $statisticheSingoloCliente = DB::table('service_user')
        ->join('users', 'service_user.user_ID', '=', 'users.id' )
        ->join('services', 'service_user.service_ID', '=', 'services.id')
        // ->select('users.name', 'users.id','service_user.service_ID')
        ->select('users.name as cliente',(DB::raw('services.name as nome_Servizio, count(*) as prenotatazioni')))
        ->whereYear('date_start', $annoAttuale)
        ->where('users.id', '=' , $idUtenteSelezionato)
        ->groupBy('users.name', 'services.name' )
        ->get();

        return response()->json($statisticheSingoloCliente); //questo é il data che avra di risposta il AJAX
    }
}