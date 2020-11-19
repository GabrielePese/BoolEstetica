@extends('layouts.main-layout')

@section('content')

@auth
    @if(Auth::user()->admin)
        Benvenuto Amministratore.
        <br>

        <a href="{{ route('create-tratt') }}">INSERISCI NUOVO TRATTAMENTO</a>
        <br>
        <a href="{{ route('create-promo') }}">INSERISCI NUOVA PROMOZIONE</a>


        <H2>Elenco prenotazioni</H2>
       
        <div class="col-xs-6 " style="">
            <H1>DA FARE</H1>
  
                
   @foreach ($prenotazioni as $item => $prenotazione)
   @if ($date_now -> lt($prenotazione -> date_end)) {{--se la data attuale lt= é piú piccola della data di fine della prenotazione inseriscilo qui--}}
       @foreach ($users as $user)
           @if ($user-> id ==$prenotazione -> user_ID ) {{--se l'id del user su cui cicla é uguale all'user_Id della tabella ponte --}}
               <p>utente : {{$user->name}}</p> {{--stampa il nome--}}
           @endif
       @endforeach
       @foreach ($services as $service)
           @if ($service-> id ==$prenotazione -> service_ID ) {{--se l'id del servizio é uguale all'service ID della tabella ponte--}}
               <p>servizio : {{$service->name}}</p>
               <p>Prezzo : {{$service ->price}} €</p>
               <hr>
           @endif
       @endforeach
       
       
    @endif
       
   @endforeach      
        </div>
        <div class="col-xs-6 " style="">
            <H1>GIA'FATTI</H1>
   @foreach ($prenotazioni as $item => $prenotazione)
   @if ($date_now -> gt($prenotazione -> date_end))
       @foreach ($users as $user)
           @if ($user-> id ==$prenotazione -> user_ID )
               <p>utente : {{$user->name}}</p>
           @endif
       @endforeach
       @foreach ($services as $service)
           @if ($service-> id ==$prenotazione -> service_ID )
               <p>servizio : {{$service->name}}</p>
               <p>Prezzo : {{$service ->price}} €</p>
               <a class="btn btn-primary" href="">LEGGI RECENSIONE</a>
               
               
               <hr>
           @endif
       @endforeach
       
    @endif
       
   @endforeach
        </div>


  {{-- da qui se non se loggato come amministratore --}}
  @else  
   
   <div class="col-xs-6 " style="">
    <H1>DA FARE</H1>
@foreach ($prenotazioni as $item => $prenotazione)
@if ($prenotazione-> user_ID == Auth::user()->id) {{-- qui gli dico se ID della tabella ponte e'uguale all'id dell'utente autenticato. quindi di mostrarmi solo le prenotazioni dell'utente autenticato. --}}
@if ($prenotazione -> deleted)
@else    
@if ($date_now -> lt($prenotazione -> date_end)) {{-- prendo solo quelli piu'piccoli con lt  --}}
@foreach ($users as $user)
@if ($user-> id ==$prenotazione -> user_ID )
<p>utente : {{$user->name}}</p>
@endif
@endforeach
@foreach ($services as $service)
@if ($service-> id ==$prenotazione -> service_ID )
<p>servizio : {{$service->name}}</p>
<p>Prezzo : {{$service ->price}} € </p>


<form action="{{route('anulla-app',  $prenotazione -> id)}}" method="POST">
    @csrf
    @method('post')
    {{-- <div>
        
        <label for=""></label>
        <input type="text">
    </div> --}}
    <button type="submit">
        
        ANNULLA APPUNTAMENTO
    </button>
</form>
<hr>
@endif
@endforeach

@endif
@endif
@endif


@endforeach      
</div>
<div class="col-xs-6 " style="">
    <H1>GIA'FATTI</H1>
@foreach ($prenotazioni as $item => $prenotazione)
@if ($prenotazione-> user_ID == Auth::user()->id)
@if ($date_now -> gt($prenotazione -> date_end))
@foreach ($users as $user)
   @if ($user-> id ==$prenotazione -> user_ID )
       <p>utente : {{$user->name}}</p>
   @endif
@endforeach
@foreach ($services as $service)
   @if ($service-> id ==$prenotazione -> service_ID )
       <p>servizio : {{$service->name}}</p>
       <p>Prezzo : {{$service ->price}} €</p>
       <p>id: {{$service -> id}}</p>
       <p>id ponte ; {{$prenotazione -> id}}</p>
    @if($prenotazione -> review_vote)
    @else
    
       <a class="btn btn-primary" href="{{route('scrivirecensione',  $prenotazione -> id)}}">SCRIVI RECENSIONE</a>
     @endif
     
       <hr>
   @endif
@endforeach
@endif
@endif

@endforeach
</div>
   
   
@endif
 
@endauth

@endsection
