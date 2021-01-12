@extends('layouts.main-layout')



@section('content')
<div class="container">
    <div class="col-lg-8 mx-auto mb-5 chisiamo">
        <h1 class="text-center" style="font-family: 'great vibes'; font-size: 65px;">Trattamenti Estetici</h1>

    </div>
    <div class="row my-5 mx-auto">
           @foreach ($trattamentiEstetica as $servizio)
        
            @if ($servizio -> delete  || $servizio -> disabled || $servizio -> id == 1)
        
            @else 
            <a href="{{route('show-tratt', $servizio -> id)}}" style="color: black;" >
            <div class="col-md-12 col-lg-6 bloccoAdmin mb-4">
                    <div class="bloccoAdminImg">
                        <img src="{{$servizio -> photo}}" alt="">
    
                    </div>
                
                <div class="text-center" style="font-family: 'Great vibes'; font-size: 30px;">
                    {{$servizio -> name}}     
                </div>      
                <div class="text-center justify-content">
                    {{$servizio -> description}} 
                </div>     
            </a>
        </div>    
            @endif
        
            @endforeach
        
    </div>
</div>


@endsection