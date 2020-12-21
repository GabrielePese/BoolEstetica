@extends('layouts.main-layout')

@section('content')
<script src="{{asset('js/calendar.js')}}" defer ></script>

@auth
@if(Auth::user()->admin)

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div id="calendar" style="margin: 30px 0;"></div>
        </div>
    </div>
</div> 

@endif

@endauth


@endsection
