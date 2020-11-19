@extends('layouts.main-layout')

@section('content')

@auth
@if (Auth::user()->admin)
{{-- questa parte la vedere il proprietario --}}
Benvenuto AMMINISTRATORE


@else

Benvenuto {{Auth::user()-> name}}


@endif  

@endauth


<div id='calendar'></div>


<br>
<h1>I NOSTRI TRATTAMENTI</h1>
<ul>
    @foreach ($service as $ser)
    @if ($ser -> disabled || $ser -> delete)
    @else
        
    <a href="{{route("show-tratt", $ser -> id)}}">
        <li>{{$ser -> name}}</li>
    </a>
    @endif
    @endforeach



@endsection
