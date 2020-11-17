@extends('layouts.main-layout')

@section('content')

@auth
@if (Auth::user()->admin)

<form action="{{route('create-promo-store')}}" method="POST">
@csrf
@method('post')

<div style="display:none;">
    <label for="service_ID">service_ID</label>
    <input type="text" name="service_ID">
</div>
<div>
    <label for="name">name</label>
    <input type="text" name="name">
</div>
<div>
    <label for="discount">discount</label>
    <input type="number" name="discount">
</div>
<button type="submit">CREA PROMO</button>
</form>
@endif
@endauth
@endsection