@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/calendar.js')}}"></script>
<input style="display:none" id="iputTempo" value="{{($servizio -> duration)}}"> 

@auth
@if (Auth::user()->admin)

<div class="container my-5">
    
        <div id="calendar"></div>
    
</div>

@if (($servizio -> id) !== 1)

<form action="{{route('prenota-post', $servizio -> id)}}" method="post"> 
    @csrf
    @method('post')
 


<div>
    Seleziona il cliente :
    <select name="user_ID" id=""> {{--  qui in name abbiamo messo user_ID cosi nel controller salviamo data[user_ID] --}}
        @foreach ($users as $user)

        
        <option value="{{$user -> id}}">{{$user -> name }}</option>
            
       
        @endforeach
</div>


<div >
    <label for="datagiorno"> Seleziona Giorno </label>
    <input id="selectDay" class="date" type="date" name="datagiorno" value="" >
</div>


<div>
    <label for="dataorario"> Seleziona Orario </label>
    <select name="dataorario" id="selectReservation" style="border: 1px solid rgba(238, 161, 238, 1);">
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

<form action="{{route('impostaferie', $servizio -> id)}}" method="post"> 
    @csrf
    @method('post')
 
<div >
    <label for="datagiorno"> Seleziona Giorno </label>
    <input id="selectDayFerie" class="date" type="date" name="datagiorno" value="" >
</div>

<div>
    <label for="dataOrarioInizio"> Seleziona Orario Inizio </label>
    <select name="dataOrarioInizio" id="dataOrarioInizio" style="border: 1px solid rgba(238, 161, 238, 1);">
    <option value="" disabled selected>Select your option</option>
    <option value="8.00">8.00</option>
    <option value="8.30">8.30</option>
    <option value="9.00">9.00</option>
    <option value="9.30">9.30</option>
    <option value="10.00">10.00</option>
    <option value="10.30">10.30</option>
    <option value="11.00">11.00</option>
    <option value="11.30">11.30</option>
    <option value="12.00">12.00</option>
    <option value="12.30">12.30</option>
    <option value="13.00">13.00</option>
    <option value="13.30">13.30</option>
    <option value="14.00">14.00</option>
    <option value="14.30">14.30</option>
    <option value="15.00">15.00</option>
    <option value="15.30">15.30</option>
    <option value="16.00">16.00</option>
    <option value="16.30">16.30</option>
    <option value="17.00">17.00</option>
    <option value="17.30">17.30</option>
    <option value="18.00">18.00</option>
    <option value="18.30">18.30</option>
    <option value="19.00">19.00</option>
    <option value="19.30">19.30</option>
   </select>
</div>

<div>
    <label for="dataOrarioFine"> Seleziona Orario Inizio </label>
    <select name="dataOrarioFine" id="dataOrarioFine" style="border: 1px solid rgba(238, 161, 238, 1);">
    <option value="" disabled selected>Select your option</option>
    <option value="8.30">8.30</option>
    <option value="9.00">9.00</option>
    <option value="9.30">9.30</option>
    <option value="10.00">10.00</option>
    <option value="10.30">10.30</option>
    <option value="11.00">11.00</option>
    <option value="11.30">11.30</option>
    <option value="12.00">12.00</option>
    <option value="12.30">12.30</option>
    <option value="13.00">13.00</option>
    <option value="13.30">13.30</option>
    <option value="14.00">14.00</option>
    <option value="14.30">14.30</option>
    <option value="15.00">15.00</option>
    <option value="15.30">15.30</option>
    <option value="16.00">16.00</option>
    <option value="16.30">16.30</option>
    <option value="17.00">17.00</option>
    <option value="17.30">17.30</option>
    <option value="18.00">18.00</option>
    <option value="18.30">18.30</option>
    <option value="19.00">19.00</option>
    <option value="19.30">19.30</option>
    <option value="20.00">20.00</option>
    </select>
</div>

<Button type="submit"> AGGIUNGI CHIUSURA</Button>
</form>

@endif

@else   {{--COMINCIA SE NON SEI UTENTE--}}
<div class="container mt-5 mb-3">
    
        <div id="calendaruser"></div>
    
</div>
    <form action="{{route('prenota-post', $servizio -> id)}}" method="post"> 
        @csrf
        @method('post')
     
    
    <div style="display:none;">
        <label for="user_ID">User_ID</label>
    <input type="number" name="user_ID" value="{{Auth::user()->id }}" >
    </div>
    

  
    <div class="container">
        <div class="row d-flex align-items-center mb-5">
            <div class="col-md-12 col-lg-4">
                <label for="datagiorno"> Seleziona Giorno </label>
                <input id="selectDay" class="date" type="date" name="datagiorno" value="" >
            </div>

            <div class="col-md-12 col-lg-4">
                <label for="dataorario"> Seleziona Orario </label>
                <select name="dataorario" id="selectReservation">
                <option value="" disabled selected>Select your option</option>
                    
                </select>
            </div>

            <div class="col-md-12 col-lg-4">
                
                <div style="display:none">
                    <label for="deleted"> deleted </label>
                    <input type="number" name="deleted" value="0">
                </div>
                
                   
                <Button id="reservation-btn" class="invisible button button1" type="submit"> Prenota Appuntamento</Button>
    
            </div>
        </div>
       
    </div>
    
    
    </form>

@endif

@endauth
  


@endsection
