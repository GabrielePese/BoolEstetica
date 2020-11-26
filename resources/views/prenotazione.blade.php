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
    <select name="dataorario" id="selectReservationUser">
        <option value="8:00">8:00</option>
        <option value="8:30">8:30</option>
        <option value="9:00">9:00</option>
        <option value="9:30">9:30</option>
        <option value="10:00">10:00</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="13:30">13:30</option>
        <option value="14:00">14:00</option>
        <option value="14:30">14:30</option>
        <option value="15:00">15:00</option>
        <option value="15:30">15:30</option>
        <option value="16:00">16:00</option>
        <option value="16:30">16:30</option>
        <option value="17:00">17:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
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
