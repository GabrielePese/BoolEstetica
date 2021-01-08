@extends('layouts.main-layout')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">

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
                    <div>
                        <a href="{{route('show-tratt', $service -> id)}}">NO</a>
                    </div>
                @else
                <form method="POST" action="{{route('aggiungipromo', $service -> id)}}">
                    @csrf
                    @method('post')
                
                    <select name="subscription" class="form-control">
                   @foreach ($promotions as $promo)
                       <option value="{{$promo-> discount}}">{{$promo -> name}}</option>
                    @endforeach
                    </select>
                       
                    <div class="mx-auto text-center">
                        <input type="submit" value="PROMO" class="mt-2 " />
                    </div>
                </form>
            
            @endif
            
            @endsection
        </div>
    </div>
</div>
