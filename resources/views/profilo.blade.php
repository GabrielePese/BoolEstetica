@extends('layouts.main-layout')

@section('content')
    

@auth
    @if(Auth::user()->admin)
        <div style="margin:20px 0; display:flex; justify-content:center; font-family: 'Great vibes'; font-size: 30px;"> Benvenuto Amministratore </div>
        <br>


        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Calendario</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('visualizzaCalendario') }}">Visualizza Calendario</a></p>
                    </div>
                </div>

                <div class="col-12 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP">Aggiungi Servizio</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('create-tratt') }}">Aggiungi Servizio</a></p>
                    </div>
                </div>

                <div class="col-12 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Promozioni</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('create-promo') }}">Visualizza Promozioni</a></p>
                    </div>
                </div>

                <div class="col-12 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Statistiche</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('statistiche') }}">Visualizza Statistiche</a></p>
                    </div>
                </div>
                
                <div class="col-12 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Ferie</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('impostaferieGet' , $id = 1) }}">Aggiungi Ferie</a></p>
                    </div>
                </div> 

            </div>
        </div>    
     @else    {{--PARTE NON ADMIN--}}

     <div class="container">
         <div class="row">
             <div class="col-md-12 col-lg-6">
                 <h2 class="text-center my-4"> I tuoi appuntamenti</h2>
                 <div class="card">
                    <div class="card-body">

                        <ul>
                            @foreach ($prenotazioniNuovo as $prenotazione)
                            @if ($date_now ->gt($prenotazione -> new_end))
                             
                            @else 
                            <li>{{$prenotazione -> title}} </li>
                            <li>{{$prenotazione -> new_start}}</li>
                            <li>{{$prenotazione -> new_end}}</li>
                            <a class="btn btn-danger mt-2" href="{{route('anulla-app', $prenotazione -> idPrenotazione)}}">Annulla prenotazione</a>
                          @endif
                    
                            @endforeach
                        </ul>
                    </div>
                 </div>
             </div>
             <div class="col-md-12 col-lg-6">
                <h2 class="text-center my-4 "> Scrivi una recenssione</h2>
                 <ul class="text-center">
                     @foreach ($prenotazioniNuovo as $prenotazione)
                     
                      @if ($date_now ->lt($prenotazione -> new_end))
                      
                      @else 
                      
                      @if ($prenotazione -> votoRecensione)
                      @else
                      <li ><a class="button button1" href="{{route('scrivirecensione', $prenotazione -> idPrenotazione)}}">{{$prenotazione -> title}} {{$prenotazione -> idPrenotazione}} </a> </li>
                      @endif
                      @endif
                
                    
                   
                     </li>
                     @endforeach
                 </ul>
              
               
             </div>
         </div>
     </div>
@endif
 
@endauth

@endsection
