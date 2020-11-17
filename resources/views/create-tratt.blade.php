@extends('layouts.main-layout')

@section('content')

@auth

@if (Auth::user()->admin)
   <form action="{{route('store-tratt')}}" method="post"> 
    @csrf
    @method('post')
   <div>
       <label for="name"> Name </label>
       <input type="text" name="name" value="">
   </div>

   <div>
    <label for="description"> description </label>
    <input type="text" name="description" value="">
</div>

<div>
    <label for="duration"> duration </label>
    <input type="number" name="duration" value="">
</div>

<div >
    <label for="price"> price </label>
    <input type="number" data-mirror name="price" value="">
</div>


<div style="display:none;">
    <label for="originalprice"> originalprice </label>
    <input type="number" data-mirror name="originalprice" value="">
</div>


<div>
    <label for="photo"> photo </label>
    <input type="text" name="photo" value="">
</div>

<div>
    <label for="video"> video </label>
    <input type="text" name="video" value="">
</div>

<div>
    <label for="promotion"> promotion </label>
    <input type="number" name="promotion" value="">
</div>

<div>
    <label for="disabled"> disabled </label>
    <input type="text" name="disabled" value="">
</div>

<div>
    <label for="delete"> delete </label>
    <input type="text" name="delete" value="">
</div>
   
<Button id="bottone" type="submit"> CREA NUOVO TRATTAMENTO</Button>
</form>
    @else 
    SOLO L'AMMINISTRATORE PUO' AGGIUGNERE NUOVI TRATTAMENTI.
@endif

@endauth       


@endsection
