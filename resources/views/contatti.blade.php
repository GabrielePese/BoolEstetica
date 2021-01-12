@extends('layouts.main-layout')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto mb-5 chisiamo">
            <h1 class="text-center" style="font-family: 'great vibes'; font-size: 65px;">Contatti</h1>

        </div>
    </div>
    <div class="row flex">
      <div class="col-md-12 col-lg-6 mappa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.1765177606385!2d10.058733215775332!3d45.80772311847602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4783dec50d56e655%3A0x984ab95657aa5cca!2sEstetica%20DeA!5e0!3m2!1sit!2sit!4v1609868435869!5m2!1sit!2sit" width="100%" height="425" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>     
      </div>
        <div class="col-md-12 col-lg-6 contattiInfo">
        <p><i class="fas fa-phone-square-alt"></i> 343 3874657</p>
        <p><i class="fas fa-map-marker-alt"></i> Via provinciale 2 Lovere</p>
        <p><i class="far fa-envelope"></i> esteticadea@gmasil.com</p>
        <p><i class="fas fa-clock"></i> Mar - Sab 8.00 - 19.00</p>
      </div>

    </div>

    <div class="row">
        <div class="col-8 mx-auto text-center contact-form">
            
            <div class="contact-image">
                <img src="{{asset('img/esteticaLogo.png')}}" alt="rocket_contact"/>
            </div>
            <form action="{{route('email')}}" method="post">
               @csrf
               @method('post')

               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="number" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="button button1 mt-3 bottoneContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea type="text" name="txtMsg" class="form-control" placeholder="Your Message" style="width: 100%; height: 150px;" required></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>

        </div>
   </div>
</div>

@endsection
