@extends('layouts.main-layout')

@section('content')
<main>
<div class="container">



    @auth
    @if (Auth::user()->admin)
    {{-- questa parte la vedere il proprietario --}}
    Benvenuto AMMINISTRATORE
    
    
    @else
    
    Benvenuto {{Auth::user()-> name}}
    
    
    @endif  
    
    @endauth
    
    
    
    
    
    <br>
    <h1>I NOSTRI TRATTAMENTI</h1>
    
    
    
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($service as $key => $ser)
            @if ($ser -> disabled || $ser -> delete)
            @else
            
            
            @if ($key == 0)
            
            <div class="carousel-item active" style="height: 500px; width: 100%;  position: relative;" >
                <a href="{{route("show-tratt", $ser -> id)}}" style="height: 500px; width: 100%;">
                    <img class="d-block" style="width:100%; height:auto;position: absolute; top:50%; left:50%; transform: translate(-50%, -50%);" src="{{$ser-> photo}}" alt="{{$ser-> photo}}">
                </a>
            </div>
            @else      
            <div class="carousel-item" style="height: 500px; width: 100%;  position: relative; top:0;">
                <a href="{{route("show-tratt", $ser -> id)}}" style="height: 500px; width: 100%;" >
                    <img class="d-block" style="width:100%; height:auto;position: absolute; top:50%; left:50%; transform: translate(-50%, -50%);" src="{{$ser-> photo}}" alt="{{$ser-> photo}}">
                </a>
            </div>
            @endif
            @endif
            @endforeach
            
            
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        
        
        
        
        <ul>
            @foreach ($service as $ser)
            @if ($ser -> disabled || $ser -> delete)
            @else
            
            <a href="{{route("show-tratt", $ser -> id)}}">
                <li>{{$ser -> name}}</li>
            </a>
            @endif
            @endforeach
            
            
            
        </div>
    </main>
        @endsection
        