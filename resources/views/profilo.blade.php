@extends('layouts.main-layout')

@section('content')
    

@auth
    @if(Auth::user()->admin)
        <div style="margin:20px 0; display:flex; justify-content:center; font-family: 'Great vibes'; font-size: 30px;"> Benvenuto Amministratore </div>
        <br>


        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Calendario</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('home') }}">Visualizza Calendario</a></p>
                    </div>
                </div>

                <div class="col-6 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Aggiungi serrvizio</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('create-tratt') }}">Aggiungi Servizio</a></p>
                    </div>
                </div>

                <div class="col-6 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Promozioni</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('create-promo') }}">Visualizza Promozioni</a></p>
                    </div>
                </div>

                <div class="col-6 col-md-3 bloccoAdmin">
                    <div class="bloccoAdminInterno">
                        <p class="bloccoAdminInternoPrimoP"> Statistiche</p>
                        <p style="margin-bottom:30px;"> <a style= "color:black;" href="{{ route('statistiche') }}">Visualizza Statistiche</a></p>
                    </div>
                </div>
            </div>
        </div>    
     

@endif
 
@endauth

@endsection
