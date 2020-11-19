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
        @foreach ($recensioni as $recensione)
        <li>{{$recensione -> name}} ha scritto:
            {{$recensione -> review_text}}</li><br>
            Ha dato {{$recensione -> review_vote}} stelle su 10. 
            <hr>
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
