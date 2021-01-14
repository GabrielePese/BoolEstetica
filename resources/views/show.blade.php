@extends('layouts.main-layout')

@section('content')

<div class="container-fluid p-0 m-0 margineShow">
            <img src="{{ $service -> photo }}" style="width:100%;" alt="sfodno">
        <h1 class="showTitolo">{{ $service -> name }}</h1>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 text-center my-5">
            <h1 style="font-family: 'great vibes'; font-size: 40px; color">Il nostro trattamento</h1>
        </div>
    </div>

    <div class="row">
        <div class="perFlex mb-5">
            <div class="col-md-12 col-lg-6">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur voluptatem delectus sapiente
                veritatis architecto atque error adipisci nobis inventore quo! Eaque eum ipsum repellendus consequatur
                magnam quisquam nisi, cupiditate in bla bla. <br>
                <p> Durata: {{ $service -> duration }} <i class="far fa-clock mt-3"></i> </p>
                <p> Costo: {{ $service -> price }} <i class="fas fa-euro-sign"></i></p>
            </div>
            <div class="col-md-12 col-lg-6 showTarttamentoFoto">
                <img src="/img/mt-1491-content-bg08.jpg" style=width:100%; alt="foto">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center prenotaSubito mb-5">
            <a href="{{ route('prenota', $service -> id, ) }}"><button class="button button1"> Prenota Subito</button></a>

            @auth
            @if(Auth::user()->admin)
            <a href="{{ route('promo', $service -> id, ) }}"><button class="button button1"> Metti in Promozione</button></a>
                {{-- questa parte la vedere il proprietario --}}
                
            
    
            @endif
        @endauth
            
        </div>
    </div>
</div>

<div class="container-fluid p-0 m-0">
       <iframe width="100%" height="800px" src="https://www.youtube.com/embed/_lLRGT_Wmqk" allowfullscreen></iframe>
</div>

<div class="container mt-5 ">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 style="font-family: 'great vibes'; font-size: 40px; color">Recensione Servizio</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(($quantitaRecensioni != 0))

            Voto: {{ ($votoRecensioniTotali / $quantitaRecensioni) }} <span class="stelle"></span> <p style="color:blue;">   {{ $quantitaRecensioni }} Recensioni </p>

        <input style="display: none;" class="numerostelle"
            value="{{ ($votoRecensioniTotali / $quantitaRecensioni) }}">
    @else
        <p>Non ci sono ancora recensioni per questo trattamento..</p>
    @endif
        </div>
        <hr>
    </div>
    <div class="row">
        
            <div class="col-md-12 contenitoreRecensioni pt-4">
           
            @foreach($recensioni as $recensione)
                @if ($recensione -> deleted ==1)
                @else 

                @if ($recensione -> review_vote)

                <div class="col-md-12 mb-4">
                    <h5> <span style="font-weight: bold;">Nome:</span>  {{ $recensione -> name }}</h5>
                    <h5><span style="font-weight: bold;">Ha votato:</span> {{ $recensione -> review_vote }} </h5>
                    <h5><span style="font-weight: bold;">Recensione: </span> {{ $recensione -> review_text }} </h5>
                </div>
                    
                @endif
                @endif
             @endforeach
        
            </div>
        

    </div>
      </div>
    </div>
</div>



  
       
      


</div>

@endsection 
