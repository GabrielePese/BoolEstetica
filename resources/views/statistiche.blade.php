@extends('layouts.main-layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{asset('js/calendar.js')}}"></script>
<script src="{{asset('js/stat.js')}}"></script>
@auth
@if (Auth::user()->admin)
<div class="container">
    
    <H1 class="text-center my-3" style="font-family: 'Great vibes';" >Statistiche</H1>
    <div class="row my-5">
    <div class="col-md-12 col-lg-6">
            <h4>Fatturato {{$annoAttuale}}: {{$fatturato}} €</h4>
            <br>
            
            
            
            @foreach ($serviziInPercentuale as $servizio)
                
            <h5 class="valoriServizi"> Il servizio {{$servizio -> name}} é stato eseguito {{$servizio -> totale_servizi_fatti}} volte. <br>
                 Questo servizio ha coperto il {{round(($servizio -> totale_servizi_fatti/$serviziTotaliAnno)*100, 1)}}% del totale.</h5> <br>
            
            @endforeach
            
        </div>
  
        <div class="col-md-12 col-lg-6 ">
            <div id="views-charts" style="width:400px; height:400px;">
                <canvas id="myCharts" style="width:400; height:400;"></canvas>
            </div>
            
        </div>

    </div>
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">

            @foreach ($fatturatoMese as $mese)
            
            <h5> Nel mese 
                @if ($mese -> month == 12 )
                Dicembre
                @elseif ($mese -> month == 11)
                Novembre
                @elseif ($mese -> month == 10)
                Ottobre
                @elseif ($mese -> month == 9)
                Settembre
                @elseif ($mese -> month == 8)
                Agosto
                @elseif ($mese -> month == 7)
                Luglio
                @elseif ($mese -> month == 6)
                Giugno
                @elseif ($mese -> month == 5)
                Maggio
                @elseif ($mese -> month == 4)
                Aprile
                @elseif ($mese -> month == 3)
                Marzo
                @elseif ($mese -> month == 2)
                Febbraio
                @elseif ($mese -> month == 1)
                Gennaio
                @endif 
                
            abbiamo fatto {{$mese -> totale_servizi_del_mese}} servizi <br>  
            che ci hanno fatto incassare {{$mese -> somma}}€ cioe' il {{round($mese -> somma / $fatturato)*100,1}}% su base annua. </h5>
                
            @endforeach

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            
            <h4>Serivizi svolti dal cliente:</h4>
            <select name="statisticheUtenti" id="statisticheUtenti">
                @foreach ($utenti as $item)
                <option value="{{$item -> id}}">{{$item -> name}}</option>
                
                @endforeach
            </select>
            
            <div id="targetStat"></div>

        </div>
        <div class="col-md-12 col-lg-6">
            
            <div id="views-chart">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>

        </div>
    </div>
</div>



@endif



@endauth
@endsection
