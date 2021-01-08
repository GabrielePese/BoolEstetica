@extends('layouts.main-layout')

@section('content')

@auth

@if (Auth::user()->admin)
   <form action="{{route('store-tratt')}}" method="post" enctype="multipart/form-data"> 
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
                            <label for="type" style="width: 30%"> Tipologia </label>
                            <select name="type" id="" style="width: 60%">
                                <option value="Estetica">Estetica</option>
                                <option value="Relax">Relax</option>
                                <option value="Decontratturanti">Decontratturanti</option>
                                <option value="Varie">Varie</option>
                            </select>
                        </div>
                     <div>
                        <label for="duration" style="width: 30%"> Durata </label>
                        <select name="duration" id="">
                            <option value="30">30</option>
                            <option value="60">60</option>
                        </select>
                         {{-- <label for="duration" style="width: 30%"> Durata </label>
                         <input type="text" name="duration"  value="" style="width: 60%"> --}}
                         
                      
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
                         <label for="photo" style="width: 30%"> Foto </label>                              {{-- il for e il name devono essere il nome della colonna del DB --}}
                         {{-- <input type="text" name="photo" value="" style="width: 60%">                         QUI VECCHIA VERSIONE CON INSERIMENTO URL--}}  
                         <input id="photo" type="file" name="photo" value="" style="width: 60%">  
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
