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
       
       {{-- <p>data : {{$prenotazione -> date_end}}</p>
       <p>voto : {{$prenotazione -> review_vote}}</p>
       <p>recensione : {{$prenotazione -> review_text}}</p> 
       <hr> --}}
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
       
       {{-- <p>data : {{$prenotazione -> date_end}}</p>
       <p>voto : {{$prenotazione -> review_vote}}</p>
       <p>recensione : {{$prenotazione -> review_text}}</p> 
       <hr> --}}
    @endif
       
   @endforeach
        </div>


  {{-- da qui se non se loggato come amministratore --}}
  @else  
   
   <div class="col-xs-6 " style="">
    <H1>DA FARE</H1>
@foreach ($prenotazioni as $item => $prenotazione)
@if ($prenotazione-> user_ID == Auth::user()->id)
@if ($date_now -> lt($prenotazione -> date_end))
@foreach ($users as $user)
   @if ($user-> id ==$prenotazione -> user_ID )
       <p>utente : {{$user->name}}</p>
   @endif
@endforeach
@foreach ($services as $service)
   @if ($service-> id ==$prenotazione -> service_ID )
       <p>servizio : {{$service->name}}</p>
       <p>Prezzo : {{$service ->price}} € </p>
       

       
       
       <hr>
   @endif
@endforeach

{{-- <p>data : {{$prenotazione -> date_end}}</p>
<p>voto : {{$prenotazione -> review_vote}}</p>
<p>recensione : {{$prenotazione -> review_text}}</p> 
<hr> --}}
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
{{-- 
<p>data : {{$prenotazione -> date_end}}</p>
<p>voto : {{$prenotazione -> review_vote}}</p>
<p>recensione : {{$prenotazione -> review_text}}</p> 
<hr> --}}
@endif
@endif

@endforeach
</div>
   
   
@endif
 
@endauth

@endsection
