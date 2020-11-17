@extends('layouts.main-layout')

@section('content')


@if ($service -> promotion)
    <p> SEI SICURO DI CANCELLARE LA PROMO ATTIVA SU QUESTO TRATTAMENTO?</p>
    <form method="POST" action="{{route('aggiungipromo', $service -> id)}}">
        @csrf
        @method('post')
    
        <select style="display:none;" name="subscription" class="form-control">
       @foreach ($promotions as $promo)
           <option value="{{$promo-> discount}}">{{$promo -> name}}</option>
        @endforeach
        </select>
           
        <input type="submit" value="SI" />
    </form>
        <a href="{{route('show-tratt', $service -> id)}}">NO</a>
    @else
    <form method="POST" action="{{route('aggiungipromo', $service -> id)}}">
        @csrf
        @method('post')
    
        <select name="subscription" class="form-control">
       @foreach ($promotions as $promo)
           <option value="{{$promo-> discount}}">{{$promo -> name}}</option>
        @endforeach
        </select>
           
        <input type="submit" value="PROMO" />
    </form>

@endif

@endsection
