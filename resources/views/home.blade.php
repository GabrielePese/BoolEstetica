@extends('layouts.main-layout')

@section('content')

<div class="container-fluid p-0">



    @auth
        @if(Auth::user()->admin)
            {{-- questa parte la vedere il proprietario --}}
            CIAO admin
        @else

        @endif
    @endauth

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($service as $key => $ser)
                @if($ser -> disabled || $ser -> delete)
                @else


                    @if($key == 0)

                        <div class="carousel-item active" style="height: 500px; width: 100%;  position: relative;">
                            <a href="{{ route("show-tratt", $ser -> id) }}"
                                style="height: 500px; width: 100%;">
                                <img class="d-block"
                                    style="width:100%; height:auto;position: absolute; top:50%; left:50%; transform: translate(-50%, -50%);"
                                    src="{{ $ser-> photo }}" alt="{{ $ser-> photo }}">
                            </a>
                        </div>
                    @else
                        <div class="carousel-item" style="height: 500px; width: 100%;  position: relative; top:0;">
                            <a href="{{ route("show-tratt", $ser -> id) }}"
                                style="height: 500px; width: 100%;">
                                <img class="d-block"
                                    style="width:100%; height:auto;position: absolute; top:50%; left:50%; transform: translate(-50%, -50%);"
                                    src="{{ $ser-> photo }}" alt="{{ $ser-> photo }}">
                            </a>
                        </div>

                    @endif
                @endif
            @endforeach


            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>

<div class="container mt-5 mb-3">
    <div class="row mb-5 text-center">
        <div class="col-12 ">
            <h2>Trattamenti</h2>
        </div>
    </div>
    <div class="row">

        <div class="col-12 col-sm-4">
            <div class="cerchioTrattamento mx-auto">
                <div class="cerchioImg">
                    <img src="{{ asset('/img/tondino.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Relax</h4>
                    <h6 class="text-justify" style="padding:0 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Quaerat quae fugiat dolorum eos voluptates ad ex, vitae nostrum unde repellat. Voluptas
                        reprehenderit architecto harum obcaecati quod nisi nostrum corporis accusantium.</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="cerchioTrattamento mx-auto">
                <div class="cerchioImg">
                    <img src="{{ asset('/img/tondino2.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Estetica</h4>
                    <h6 class="text-justify" style="padding:0 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Quaerat quae fugiat dolorum eos voluptates ad ex, vitae nostrum unde repellat. Voluptas
                        reprehenderit architecto harum obcaecati quod nisi nostrum corporis accusantium.</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="cerchioTrattamento mx-auto">
                <div class="cerchioImg">
                    <img src="{{ asset('/img/tondino3.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Decontratturanti</h4>
                    <h6 class="text-justify" style="padding:0 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Quaerat quae fugiat dolorum eos voluptates ad ex, vitae nostrum unde repellat. Voluptas
                        reprehenderit architecto harum obcaecati quod nisi nostrum corporis accusantium.</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row  text-center ">
        <div class="col-12 mt-5 mb-3">
            <h2>I piú richiesti</h2>
        </div>
    </div>
    <div class="row">


        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide1.1.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide1.2.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide3.1.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide3.2.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide3.3.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4">
            <div class="quadratoTrattamento mx-auto">
                <div class="quadratoImg">
                    <img src="{{ asset('/img/slide5.1.jpg') }}" alt="1">
                </div>
                <div class="text-center">
                    <h4>Massaggio Relax</h4>
                    <h4> 30 Minuti - 60€ </h4>
                </div>
            </div>
        </div>
    </div>
</div>


</div>





<div class="container">
    <div class="row">
        <div class="bloccoInstagram">
            <div class="bloccoCarouselBianco">
    
            </div>
            <div id="carouselExampleIndicators" class="carousel slide instaCarousel" data-ride="carousel">
    
                <div class="carousel-inner" id="instafeed-container"> </div>
    
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    
            <div class="bloccoCarouselBianco">
    
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>

<script type="text/javascript">
    var userFeed = new Instafeed({
        get: 'user',
        target: "instafeed-container",
        resolution: 'low_resolution',
        accessToken: 'IGQVJXMzZA0R05OU25QeVVJNm53OTJGZAUxvSk5PQjRRVTBGNlBhcDFZAZA05LcXAtUVVHRjh6OWw0T1NKVnR5cXQ0Rm16RFAyMnQ2RWNUTUpiaGszRkZAiR2lFMVFRd1o5WFd6MklxeDVHMGJKV0VJR2tXcQZDZD'
    });



    userFeed._options.template = `<div class="carousel-item fotoInsta"> <img src="@{{ image }}"> </div> `;



    userFeed.run();
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(function () {
            for (var i = 0; i < 1; i++) {
                document.querySelectorAll('div.fotoInsta')[i].classList.add('active');
            }
        }, 500)


    });

</script>













@endsection
