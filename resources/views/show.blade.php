@extends('layouts.main-layout')

@section('content')


<h1>{{$service -> name}}</h1>
{{$service -> name}}
    {{$service -> description}}<br>
    {{$service -> duration}}<br>
    {{$service -> price}}<br>
    <img style="width: 400px; heigth: 400px; border-radius: 10px;"src="{{$service -> photo}}" alt=""><br>
    {{$service -> video}}<br>
    {{$service -> promotion}}<br>
    {{$service -> disabled}}<br>
    {{$service -> delete}}
    <br>

        <a href="{{route('prenota', $service -> id, )}}">PRENOTA IL TUO TRATTAMENTO ORA</a>
        <br>
        <br>

    <ul>
        <h2>RECENSIONI:</h2>
        @if (($quantitaRecensioni != 0))
            
        <span class="stelle"></span> <span>su {{$quantitaRecensioni}} recensioni.</span> 
        
        <input style="display: none;" class="numerostelle" value="{{($votoRecensioniTotali / $quantitaRecensioni)}}" >
        @else 
        <p>Non ci sono ancora recensioni per questo trattamento..</p>
        @endif
        
        @foreach ($recensioni as $recensione)
        <div style=" padding-left:20px; list-style: none; margin-bottom:20px">
            
            <li>{{$recensione -> name}} ha scritto:<br>
                {{$recensione -> review_text}}</li>
                Ha votato {{$recensione -> review_vote}} / 5. 
        </div>
            
        @endforeach
    </ul>
        @auth
            
        @if (Auth::user() -> admin)
        @if ($service -> promotion)
        <a href="{{route('promo', $service -> id, )}}">DISATTIVA PROMO</a>
        @else
        <a href="{{route('promo', $service -> id, )}}">AGGIUNGI PROMOZIONE A QUESTO SERVIZIO</a>
        @endif
        @endif
        @endauth
@endsection
