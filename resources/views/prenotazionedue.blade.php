@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/calendar.js')}}"></script>
@auth
@if (Auth::user()->admin)

<div id="calendar"></div>

<form action="{{route('prenota-post', $servizio -> id)}}" method="post"> 
    @csrf
    @method('post')
 
<div>
    Seleziona il cliente :
    <select name="dataorario" id="">
        @foreach ($users as $user)
        @if ($user -> admin)

        @else 
        <option value="{{$user -> id}}">{{$user-> name}}</option>

        @endif
        
        @endforeach      
    </select>
</div>


<div>
    <label for="datagiorno"> Seleziona Giorno </label>
    <input type="date" name="datagiorno" value="" >
</div>



<div>
    <label for="dataorario"> Seleziona Orario </label>
    <select name="dataorario" id="">
        <option value="8:00">8:00</option>
        <option value="8:30">8:30</option>
        <option value="9:00">9:00</option>
        <option value="9:30">9:30</option>
    </select>
</div>

<div style="display:none">
    <label for="deleted"> deleted </label>
    <input type="number" name="deleted" value="0">
</div>

   
<Button type="submit"> AGGIUNGI APPUNTAMENTO</Button>
</form>

@else
<div id="calendaruser"></div>
    <form action="{{route('prenota-post', $servizio -> id)}}" method="post"> 
        @csrf
        @method('post')
     
    
    <div style="display:none;">
        <label for="user_ID">User_ID</label>
    <input type="number" name="user_ID" value="{{Auth::user()->id }}" >
    </div>
    

  
    
    <br><br><br>
    <div>
        <label for="datagiorno"> Seleziona Giorno </label>
        <input id="ciao" class="date" type="date" name="datagiorno" value="" >
    
            
        <a href="{{route('controlloData', $servizio)}}">CONTROLLA DISP</a>
        
    </div>
    
    
    <div>
        <label for="dataorario"> Seleziona Orario </label>
        <select name="dataorario" id="">
            @foreach ($date as $data)
                <option value="{{$data -> date_start}}">{{$data -> date_start}}</option>
            @endforeach
        </select>
    </div>
    
    <div style="display:none">
        <label for="deleted"> deleted </label>
        <input type="number" name="deleted" value="0">
    </div>
    
       
    <Button type="submit"> AGGIUNGI APPUNTAMENTO</Button>
    </form>

@endif

@endauth
  


@endsection
