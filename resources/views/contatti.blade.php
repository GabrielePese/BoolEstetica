@extends('layouts.main-layout')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h1 class="text-center" style="font-family: 'great vibes'; font-size: 65px;">Contatti</h1>

        </div>
    </div>
    <div class="row">
      <div class="col-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26464.7166304507!2d10.054343518973639!3d45.79602232326587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x984ab95657aa5cca!2sEstetica%20DeA!5e0!3m2!1sit!2sit!4v1609344692098!5m2!1sit!2sit" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
    </div>

    <div class="row">
        <div class="col-8 mx-auto text-center contact-form">
            
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
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
