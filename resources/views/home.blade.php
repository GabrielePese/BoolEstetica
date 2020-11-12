@extends('layouts.main-layout')

@section('content')

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{ __('You are logged in!') }}
</div>
</div>
</div>
</div>
</div> --}}




@auth

@foreach ($admin as $a)

@if ($a -> email == Auth::user()->email)
{{-- questa parte la vedere il proprietario --}}
<a href="{{route('create-tratt')}}">INSERISCI NUOVO TRATTAMENTO</a>


@else

SEI UTENTE REGISTRATO MA NON SEI AMMINISTATORE

@endif
@endforeach
@endauth
<br>
<h1>I NOSTRI TRATTAMENTI</h1>
<ul>
    @foreach ($service as $ser)
    <a href="{{route("show-tratt", $ser -> id)}}">
        <li>{{$ser -> name}}</li>
    </a>
    @endforeach
</ul>

@endsection
