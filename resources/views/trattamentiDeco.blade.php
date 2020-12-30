@extends('layouts.main-layout')



@section('content')
<div class="container">
    <div class="col-8 mx-auto my-5">
        <h1 class="text-center" style="font-family: 'great vibes'; font-size: 65px;">Trattamenti Decontratturanti</h1>

    </div>
    <div class="row my-5">
           @foreach ($trattamentiDeco as $servizio)
        
            @if ($servizio -> delete  || $servizio -> disabled || $servizio -> id == 1)
        
            @else 
            <a href="{{route('show-tratt', $servizio -> id)}}" style="color: black;" >
            <div class="col-12 col-md-4 bloccoAdmin mb-4">
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