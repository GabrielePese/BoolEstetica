@extends('layouts.main-layout')

@section('content')

@auth

@if (Auth::user()->admin)
   <form action="{{route('store-tratt')}}" method="post"> 
    @csrf
    @method('post')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <H1 class="text-center my-2" style="font-family: 'Great vibes';" > Aggiungi Servizio</H1>
                    <div class="card-body d-flex align-items-space-between justify-content-center flex-column lineHeight">
                        <div>
                            <label for="name" style="width: 30%"> Nome </label>
                            <input type="text" name="name" value="" style="width: 60%">
                        </div>
                     
                        <div>
                         <label for="description" style="width: 30%"> Descrizione </label>
                         <input type="text" name="description" value="" style="width: 60%">
                     </div>
                     
                     <div>
                         <label for="duration" style="width: 30%"> Durata </label>
                         <input type="text" name="duration"  value="" style="width: 60%">
                         
                      
                     </div>
                     
                     <div >
                         <label for="price" style="width: 30%"> Prezzo </label>
                         <input type="number" data-mirror name="price" value="" style="width: 60%">
                     </div>
                     
                     
                     <div style="display:none;">
                         <label for="originalprice"> originalprice </label>
                         <input type="number" data-mirror name="originalprice" value="" style="width: 60%">
                     </div>
                     
                     
                     <div>
                         <label for="photo" style="width: 30%"> Foto </label>
                         <input type="text" name="photo" value="" style="width: 60%">
                     </div>
                     
                     <div>
                         <label for="video" style="width: 30%"> Video </label>
                         <input type="text" name="video" value="" style="width: 60%">
                     </div>
                     
                     <div>
                         <label for="promotion" style="width: 30%"> Promozione </label>
                         <input type="number" name="promotion" value="" style="width: 60%">
                     </div>
                     
                     <div>
                         <label for="disabled" style="width: 30%"> Disabilitato </label>
                         <input type="text" name="disabled" value="" style="width: 60%">
                     </div>
                     
                     <div style="display:none">
                         <label for="delete" style="width: 30%; "> Eliminato </label>
                         <input type="text" name="delete" value="0" style="width: 60%">
                     </div>
                        
                     <Button class="button button1 mt-5" id="bottone" type="submit"> CREA NUOVO TRATTAMENTO</Button>
            
                    </div>
                </div>
            </div>
        </div>
   
    </div>

</form>
    @else 
    SOLO L'AMMINISTRATORE PUO' AGGIUGNERE NUOVI TRATTAMENTI.
@endif

@endauth       


@endsection
