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
     @else
     <div class="container">
         
              Benvenuto {{Auth::user()-> name}} <br>
         
              NON CI SONO DATI - PRENOTA ALMENO UN'APPUNTAMENTO

     </div>
@endif
 
@endauth

<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <a class="btn button button1" style="width:200px; display:block; margin: 0 auto;" href="{{route('home')}}"> HOMEPAGE</a>

        </div>

    </div>
</div>


    
   


@endsection
