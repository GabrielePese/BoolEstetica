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

        <a href="{{route('prenota', $service -> id, Auth::user()->id)}}">PRENOTA IL TUO TRATTAMENTO ORA</a>
@endsection
