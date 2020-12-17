@extends('layouts.main-layout')

@section('content')

{{$id}}




<form action="{{route('recensione-post' ,$tabellaponte -> id)}}" method="post">   {{-- qui passo l'id della tabellaponte cioe' l'id della prenotazione --}}
    @csrf
    @method('post')
    
    <div style="display:none;">
        <label for="service_ID"> service_ID </label>
        <input type="number" name="service_ID" value="{{$tabellaponte -> service_ID}}">
    </div>
    <div style="display:none;">
        <label for="user_ID"> user_ID </label>
        <input type="number" name="user_ID" value="{{$tabellaponte -> user_ID}}">
    </div>
    <div style="display:none;">
        <label for="date_start">date_start </label>
        <input type="text" name="date_start" value="{{$tabellaponte -> date_start}}">
    </div>
    <div style="display:none;">
        <label for="date_end">date_end </label>
        <input type="text" name="date_end" value="{{$tabellaponte -> date_end}}">
    </div>
    
    <div>
        <label for="review_vote"> review_vote </label>
        <select name="review_vote" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        
    </div>
    
    <div>
        <label for="review_text"> review_text </label>
        <input type="text" name="review_text" value="" required>
    </div>
    
    <div style="display:none">
        <label for="deleted"> deleted </label>
        <input type="number" name="deleted" value="0">
    </div>
    
    
    <Button type="submit"> AGGIUNGI APPUNTAMENTO</Button>
</form>

 
@endsection
