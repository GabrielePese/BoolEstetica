@extends('layouts.main-layout')

@section('content')


    <form action="{{route('prenota-post', $servizio -> id)}}" method="post"> 
        @csrf
        @method('post')
     
    
   
    
    {{-- <div>
        <label for="review_vote"> review_vote </label>
        <input type="number" name="review_vote" value="">
    </div>
    
    <div>
        <label for="review_text"> review_text </label>
        <input type="text" name="review_text" value="">
    </div>
     --}}
    <div style="display:none">
        <label for="deleted"> deleted </label>
        <input type="number" name="deleted" value="0">
    </div>
    
       
    <Button type="submit"> AGGIUNGI APPUNTAMENTO</Button>
    </form>
  


@endsection
