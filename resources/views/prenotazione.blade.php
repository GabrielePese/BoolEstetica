@extends('layouts.main-layout')

@section('content')


    <form action="{{route('prenota-post')}}" method="post"> 
        @csrf
        @method('post')
       <div >
           <label for="service_ID"> service_ID </label>
           <input type="text" name="service_ID" value="1">
       </div>
    
       <div >
        <label for="user_ID"> user_ID </label>
        <input type="text" name="user_ID" value="1">
    </div>
    
    <div>
        <label for="date_end"> date_end </label>
        <input type="number" name="date_end" value="">
    </div>
    
    <div>
        <label for="riview_vote"> riview_vote </label>
        <input type="number" name="riview_vote" value="">
    </div>
    
    <div>
        <label for="riview_text"> riview_text </label>
        <input type="text" name="riview_text" value="">
    </div>
    
    <div>
        <label for="deleted"> deleted </label>
        <input type="number" name="deleted" value="">
    </div>
    
       
    <Button type="submit"> AGGIUNGI APPUNTAMENTO</Button>
    </form>
  


@endsection
