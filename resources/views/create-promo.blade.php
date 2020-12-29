@extends('layouts.main-layout')

@section('content')

@auth
@if (Auth::user()->admin)

<form action="{{route('create-promo-store')}}" method="POST">
@csrf
@method('post')





<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <div class="card">
                
                    <H1 class="text-center my-2" style="font-family: 'Great vibes';" >Aggiungi Promo</H1>
                
                <div class="card-body d-flex align-items-space-between justify-content-center flex-column lineHeight">
                    
                    <div style="display:none;">
                        <label for="service_ID">service_ID</label>
                        <input type="text" name="service_ID">
                    </div>
                    <div>
                        <label for="name" style="width: 30%">Nome Promo</label>
                        <input type="text" name="name" style="width: 60%">
                    </div>
                    <div>
                        <label for="discount" style="width: 30%">Percentuale di Sconto</label>
                        <input type="number" name="discount" style="width: 60%">
                    </div>
                    <button type="submit" class="button button1 mt-5">Crea Promo</button>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
</form>

@endif
@endauth
@endsection