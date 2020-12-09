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
    <select name="cliente" id="">
        @foreach ($users as $user)
      
        <option value="{{$user -> id}}">{{$user-> name}}</option>

        
        
        @endforeach      
    </select>
</div>


<div>
    <label for="datagiorno"> Seleziona Giorno </label>
    <input id="selectDay" class="date" type="date" name="datagiorno" value="" >
</div>


<div>
    <label for="dataorario"> Seleziona Orario </label>
    <select name="dataorario" id="selectReservation">
    <option value="" disabled selected>Select your option</option>
        
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
    

  
    
    <div>
        <label for="datagiorno"> Seleziona Giorno </label>
        <input id="selectDay" class="date" type="date" name="datagiorno" value="" >
    </div>
    
    
    <div>
        <label for="dataorario"> Seleziona Orario </label>
        <select name="dataorario" id="selectReservation">
        <option value="" disabled selected>Select your option</option>
            
        </select>
    </div>
    
    <div style="display:none">
        <label for="deleted"> deleted </label>
        <input type="number" name="deleted" value="0">
    </div>
    
       
    <Button id="reservation-btn" class="invisible" type="submit"> AGGIUNGI APPUNTAMENTO</Button>
    </form>

@endif

@endauth
  


@endsection
