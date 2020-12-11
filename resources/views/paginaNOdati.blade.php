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
<br>
NON CI SONO DATI - PRENOTA ALMENO UN'APPUNTAMENTO

<a class="btn btn-primary" href="{{route('home')}}"> TORNA ALLA HOME </a>
    
   


@endsection
